#!/usr/bin/env python3
from __future__ import annotations

import re
import shlex
import shutil
import subprocess
import time
from pathlib import Path

import pexpect


REPO_ROOT = Path(__file__).resolve().parents[1]
LOCAL_ROOT = REPO_ROOT / "local-env"
ENV_FILE = REPO_ROOT / ".env.site_re"
REMOTE_HOST = None
REMOTE_USER = None
REMOTE_PASS = None
REMOTE_DOCROOT = None

LOCAL_URL = "http://site-re.local:8080"
LOCAL_DB_NAME = "gest0rmail"
LOCAL_DB_USER = "gest0rmail"
LOCAL_DB_PASSWORD = "localpass"
LOCAL_DB_HOST = "db"
SSH_KEY = Path.home() / ".ssh/site_re_stage2"


def load_env_file(path: Path) -> dict[str, str]:
    values: dict[str, str] = {}
    for raw_line in path.read_text(encoding="utf-8").splitlines():
        line = raw_line.strip()
        if not line or line.startswith("#") or "=" not in line:
            continue
        key, value = line.split("=", 1)
        values[key.strip()] = value.strip()
    return values


def run(cmd: list[str], *, input_text: str | None = None, check: bool = True) -> subprocess.CompletedProcess[str]:
    return subprocess.run(
        cmd,
        input=input_text,
        text=True,
        capture_output=True,
        check=check,
    )


def ssh_password_script(script: str) -> str:
    assert REMOTE_HOST and REMOTE_USER and REMOTE_PASS
    child = pexpect.spawn(
        f"ssh -o StrictHostKeyChecking=accept-new {REMOTE_USER}@{REMOTE_HOST} bash -s",
        encoding="utf-8",
        timeout=300,
    )
    idx = child.expect([r"[Pp]assword:", r"Are you sure you want to continue connecting", pexpect.EOF, pexpect.TIMEOUT])
    if idx == 1:
        child.sendline("yes")
        idx = child.expect([r"[Pp]assword:", pexpect.EOF, pexpect.TIMEOUT])
    if idx == 0:
        child.sendline(REMOTE_PASS)
    else:
        raise RuntimeError(f"SSH prompt failed: {child.before}")
    child.sendline(script)
    child.sendeof()
    child.expect(pexpect.EOF)
    child.close()
    if child.exitstatus not in (0, None):
        raise RuntimeError(child.before)
    return child.before


def ssh_script(script: str) -> str:
    assert REMOTE_HOST and REMOTE_USER
    proc = subprocess.run(
        [
            "ssh",
            "-i",
            str(SSH_KEY),
            "-o",
            "StrictHostKeyChecking=accept-new",
            f"{REMOTE_USER}@{REMOTE_HOST}",
            "bash",
            "-s",
        ],
        input=script,
        text=True,
        capture_output=True,
        check=True,
    )
    return proc.stdout


def ensure_ssh_keypair() -> None:
    SSH_KEY.parent.mkdir(parents=True, exist_ok=True)
    if not SSH_KEY.exists():
        run([
            "ssh-keygen",
            "-t",
            "ed25519",
            "-N",
            "",
            "-f",
            str(SSH_KEY),
        ])


def install_public_key() -> None:
    assert REMOTE_HOST and REMOTE_USER
    pubkey = SSH_KEY.with_suffix(".pub").read_text(encoding="utf-8").strip()
    script = f"""set -euo pipefail
mkdir -p ~/.ssh
chmod 700 ~/.ssh
touch ~/.ssh/authorized_keys
grep -qxF {shlex.quote(pubkey)} ~/.ssh/authorized_keys || echo {shlex.quote(pubkey)} >> ~/.ssh/authorized_keys
chmod 600 ~/.ssh/authorized_keys
"""
    ssh_password_script(script)


def rsync_pull(src: str, dst: Path) -> None:
    assert REMOTE_HOST and REMOTE_USER
    dst.parent.mkdir(parents=True, exist_ok=True)
    proc = subprocess.run(
        [
            "rsync",
            "-az",
            "--delete",
            "-e",
            f"ssh -i {SSH_KEY} -o StrictHostKeyChecking=accept-new",
            f"{REMOTE_USER}@{REMOTE_HOST}:{src}",
            str(dst),
        ],
        text=True,
        capture_output=True,
        check=True,
    )


def ensure_hosts_entry() -> None:
    hosts_line = "127.0.0.1 site-re.local"
    cmd = [
        "sudo",
        "sh",
        "-lc",
        f"grep -q 'site-re.local' /etc/hosts || echo '{hosts_line}' >> /etc/hosts",
    ]
    run(cmd)


def patch_local_wp_config(wp_config: Path) -> None:
    text = wp_config.read_text(encoding="utf-8")
    replacements = {
        r"define\( 'DB_HOST', '.*?' \);": "define( 'DB_HOST', 'db' );",
        r"define\( 'DB_NAME', 'gest0rmail' \);": "define( 'DB_NAME', 'gest0rmail' );",
        r"define\( 'DB_USER', 'gest0rmail' \);": "define( 'DB_USER', 'gest0rmail' );",
        r"define\( 'DB_PASSWORD', '.*?' \);": "define( 'DB_PASSWORD', 'localpass' );",
        r"define\( 'WP_DEBUG', false \);": "define( 'WP_DEBUG', true );\ndefine( 'WP_DEBUG_LOG', true );\ndefine( 'WP_DEBUG_DISPLAY', false );",
    }
    for pattern, repl in replacements.items():
        text = re.sub(pattern, repl, text, count=1)
    if "WP_HOME" not in text:
        text = text.replace(
            "/* That's all, stop editing! Happy publishing. */",
            f"define( 'WP_HOME', '{LOCAL_URL}' );\ndefine( 'WP_SITEURL', '{LOCAL_URL}' );\n\n/* That's all, stop editing! Happy publishing. */",
            1,
        )
    wp_config.write_text(text, encoding="utf-8")


def update_db_urls() -> None:
    run(
        [
            "docker",
            "compose",
            "-f",
            str(LOCAL_ROOT / "docker-compose.yml"),
            "exec",
            "-T",
            "db",
            "mysql",
            "-uroot",
            "-prootpass",
            LOCAL_DB_NAME,
            "-e",
            f"UPDATE wp_options SET option_value='{LOCAL_URL}' WHERE option_name IN ('home','siteurl');",
        ]
    )


def create_remote_dump_script() -> tuple[str, str, str]:
    assert REMOTE_DOCROOT is not None
    dump_dir = f"/home/g/{REMOTE_USER}/stage2-dumps"
    dump_path = f"{dump_dir}/site-re-db-{time.strftime('%Y%m%d_%H%M%S')}.sql"
    ssh_script(
        f"mkdir -p {shlex.quote(dump_dir)} && "
        f"php8.3 ~/bin/wp-cli.phar --path={shlex.quote(REMOTE_DOCROOT)} db export {shlex.quote(dump_path)} --quiet"
    )
    return "", "", dump_path


def download_remote_dump(remote_dump_path: str) -> Path:
    timestamp = time.strftime("%Y%m%d_%H%M%S")
    dump_path = LOCAL_ROOT / "backups" / f"remote-db-{timestamp}.sql"
    subprocess.run(
        [
            "scp",
            "-i",
            str(SSH_KEY),
            "-o",
            "StrictHostKeyChecking=accept-new",
            f"{REMOTE_USER}@{REMOTE_HOST}:{remote_dump_path}",
            str(dump_path),
        ],
        check=True,
        text=True,
        capture_output=True,
    )
    return dump_path


def cleanup_remote_dump(remote_path: str, dump_path: str) -> None:
    ssh_script(f"rm -f {remote_path} {dump_path}")


def import_db(dump_path: Path) -> None:
    run(["docker", "compose", "-f", str(LOCAL_ROOT / "docker-compose.yml"), "up", "-d"], check=True)
    for _ in range(30):
        ready = subprocess.run(
            [
                "docker",
                "compose",
                "-f",
                str(LOCAL_ROOT / "docker-compose.yml"),
                "exec",
                "-T",
                "db",
                "mysqladmin",
                "ping",
                "-uroot",
                "-prootpass",
                "--silent",
            ],
            text=True,
            capture_output=True,
        )
        if ready.returncode == 0:
            break
        time.sleep(2)
    last_error: subprocess.CalledProcessError | None = None
    for _ in range(8):
        try:
            subprocess.run(
                [
                    "bash",
                    "-lc",
                    (
                        f"docker compose -f {shlex.quote(str(LOCAL_ROOT / 'docker-compose.yml'))} "
                        f"exec -T db mysql -uroot -prootpass {LOCAL_DB_NAME} < {shlex.quote(str(dump_path))}"
                    ),
                ],
                text=True,
                capture_output=True,
                check=True,
            )
            last_error = None
            break
        except subprocess.CalledProcessError as exc:
            last_error = exc
            time.sleep(3)
    if last_error is not None:
        raise last_error
    update_db_urls()


def smoke_test() -> None:
    for path in ["/", "/wp-login.php", "/wp-admin/"]:
        out = run(["curl", "--noproxy", "*", "-sS", "-o", "/dev/null", "-w", "%{http_code}", f"{LOCAL_URL}{path}"])
        if out.stdout.strip() not in {"200", "301", "302"}:
            raise RuntimeError(f"Smoke test failed for {path}: {out.stdout}")


def main() -> None:
    global REMOTE_HOST, REMOTE_USER, REMOTE_PASS, REMOTE_DOCROOT
    values = load_env_file(ENV_FILE)
    REMOTE_HOST = values["SSH_HOST"]
    REMOTE_USER = values["SSH_USER"]
    REMOTE_PASS = values["SSH_PASS"]
    REMOTE_DOCROOT = f"/home/g/{REMOTE_USER}/дом-эксперт_рф/public_html"

    ensure_ssh_keypair()
    install_public_key()

    LOCAL_ROOT.mkdir(parents=True, exist_ok=True)
    (LOCAL_ROOT / "backups").mkdir(parents=True, exist_ok=True)
    (LOCAL_ROOT / "work").mkdir(parents=True, exist_ok=True)
    if (LOCAL_ROOT / "wordpress").exists():
        shutil.rmtree(LOCAL_ROOT / "wordpress")
    (LOCAL_ROOT / "wordpress").mkdir(parents=True, exist_ok=True)

    ensure_hosts_entry()
    ssh_script("mkdir -p ~/deploy/site_re/")

    remote_path, token, remote_dump_path = create_remote_dump_script()
    try:
        dump_path = download_remote_dump(remote_dump_path)
    finally:
        cleanup_remote_dump(remote_path, remote_dump_path)

    rsync_pull(f"{REMOTE_DOCROOT}/", LOCAL_ROOT / "wordpress")
    patch_local_wp_config(LOCAL_ROOT / "wordpress" / "wp-config.php")
    import_db(dump_path)
    smoke_test()

    print("BOOTSTRAP_OK")
    print(f"Local clone: {LOCAL_ROOT / 'wordpress'}")
    print(f"Local URL: {LOCAL_URL}")
    print(f"Remote dump: {dump_path}")


if __name__ == "__main__":
    main()
