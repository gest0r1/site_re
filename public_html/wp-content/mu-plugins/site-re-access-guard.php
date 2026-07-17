<?php
defined('ABSPATH') || exit;

$home_dir = getenv('HOME');
$production_config = $home_dir ? rtrim($home_dir, '/') . '/deploy/site_re/config/site-re-production.php' : '';
if (is_file($production_config)) {
    require_once $production_config;
}

if (!defined('SITE_RE_ACCESS_LOCKDOWN') || !SITE_RE_ACCESS_LOCKDOWN) {
    return;
}

$allowed_ips = defined('SITE_RE_ALLOWED_IPS') && is_array(SITE_RE_ALLOWED_IPS)
    ? SITE_RE_ALLOWED_IPS
    : ['10.0.10.66'];

$remote_ip = $_SERVER['REMOTE_ADDR'] ?? '';
if (in_array($remote_ip, $allowed_ips, true)) {
    return;
}

status_header(403);
nocache_headers();
exit('Access denied.');
