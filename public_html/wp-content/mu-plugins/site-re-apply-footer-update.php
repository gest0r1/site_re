<?php
/**
 * One-shot mu-plugin to apply footer contacts update.
 * Trigger: curl https://дом-эксперт.рф/?de_apply_footer=1
 * Self-deactivates after success.
 */

// Only run when explicitly triggered
if (!isset($_GET['de_apply_footer'])) {
    return;
}

// Prevent multiple runs
$done = get_option('de_footer_update_done', false);
if ($done) {
    die("Already done.\n");
}

// Auth — check that request comes from trusted source (same server or our IP)
$allowed_ips = ['77.222.40.251', '127.0.0.1', '::1', '172.17.0.1', '95.164.90.158'];
$remote = $_SERVER['REMOTE_ADDR'] ?? '';
if (!in_array($remote, $allowed_ips, true)) {
    die("Forbidden.\n");
}

header('Content-Type: text/plain; charset=utf-8');
echo "=== Footer Contacts Update ===\n\n";

// ── 1. UPDATE WIDGET4 (block-11) ──────────────────────────────────────────

$widget_block = get_option('widget_block');
$found = false;

if (is_array($widget_block)) {
    foreach ($widget_block as $id => $data) {
        if (is_array($data) && !empty($data['content']) && str_contains($data['content'], 'Контакты')) {
            $widget_block[$id]['content'] = get_new_widget_content();
            update_option('widget_block', $widget_block);
            echo "✅ Widget $id (block-$id) updated\n";
            $found = true;
            break;
        }
    }
}

if (!$found) {
    echo "❌ Could not find Контакты widget\n";
}

// ── 2. REMOVE FOOTER-SOCIAL FROM TOP ROW ─────────────────────────────────

$mods = get_theme_mods();
if (!is_array($mods)) {
    $mods = [];
}

$footer_items = $mods['footer_items'] ?? [];

if (isset($footer_items['top'])) {
    unset($footer_items['top']);
    $mods['footer_items'] = $footer_items;
    set_theme_mod('footer_items', $footer_items);
    echo "✅ Footer top row removed\n";
} else {
    echo "⚠️ No footer top row found\n";
}

// ── 3. UPDATE CONTACTS PAGE (ID: 68) ──────────────────────────────────────

$contact_page_id = 68;
$contact_page = get_post($contact_page_id);

if (!$contact_page) {
    echo "❌ Contacts page not found\n";
} else {
    $old_content = $contact_page->post_content;
    $new_checklist = get_new_checklist_html();

    $pattern = '/<ul\s+class\s*=\s*"de-checklist">.*?<\/ul>/s';
    $new_content = preg_replace($pattern, '___MARKER___', $old_content, 1, $count);

    if ($count > 0) {
        $new_content = str_replace('___MARKER___', $new_checklist, $new_content);
        echo "✅ Checklist replaced\n";
    } else {
        // Fallback: replace section with Контактные данные
        $section_pat = '/(<section[^>]*>.*?<h2[^>]*>Контактные данные.*?<\/section>)/s';
        $new_content = preg_replace($section_pat, '___MARKER___', $old_content, 1, $count);
        if ($count > 0) {
            $new_section = '<section class="de-section">' . "\n" . '<h2>Контактные данные</h2>' . "\n" . $new_checklist . "\n" . '</section>';
            $new_content = str_replace('___MARKER___', $new_section, $new_content);
            echo "✅ Контактные данные section replaced\n";
        } else {
            echo "⚠️ Section not found, appending before Форма\n";
            $new_content = str_replace(
                '<section class="de-section">' . "\n" . '<h2>Форма</h2>',
                $new_checklist . "\n" . '</section>' . "\n\n" . '<section class="de-section">' . "\n" . '<h2>Форма</h2>',
                $old_content
            );
        }
    }

    $result = wp_update_post([
        'ID' => $contact_page_id,
        'post_content' => $new_content,
    ], true);

    if (is_wp_error($result)) {
        echo "❌ Contacts page error: " . $result->get_error_message() . "\n";
    } else {
        echo "✅ Contacts page updated\n";
    }
}

// ── 4. FLUSH CACHE ────────────────────────────────────────────────────────

if (function_exists('wp_cache_clear_cache')) {
    wp_cache_clear_cache();
    echo "✅ Cache flushed\n";
}

// ── 5. MARK DONE ──────────────────────────────────────────────────────────

update_option('de_footer_update_done', true);
echo "\n=== Done ===\n";

// ── HELPER FUNCTIONS ──────────────────────────────────────────────────────

function get_new_widget_content() {
    return <<<HTML
<h3 style="color:#FFFFFF;font-size:18px;font-weight:700;line-height:1.25;margin:0 0 14px;">Контакты</h3>
<p style="margin:0 0 8px;color:#D8DEE8;font-size:14px;">Связаться с экспертом</p>
<p style="margin:0 0 8px;color:#D8DEE8;font-size:14px;line-height:1.55;display:flex;align-items:center;gap:8px;">
  <span style="display:inline-flex;align-items:center;justify-content:center;width:18px;height:18px;color:#C8A468;flex-shrink:0;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
  <span><a href="tel:+79122251788" style="color:#D8DEE8;text-decoration:none;">+7 (912) 22-51-788</a> <span style="color:#98A2B3;font-size:12px;">моб.</span></span>
</p>
<p style="margin:0 0 8px;color:#D8DEE8;font-size:14px;line-height:1.55;display:flex;align-items:center;gap:8px;">
  <span style="display:inline-flex;align-items:center;justify-content:center;width:18px;height:18px;color:#C8A468;flex-shrink:0;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></span>
  <span><a href="mailto:natalia@xn----gtbetilkjgn9i.xn--p1ai" style="color:#D8DEE8;text-decoration:none;">natalia@дом-эксперт.рф</a></span>
</p>
<p style="margin:0 0 8px;color:#D8DEE8;font-size:14px;line-height:1.55;display:flex;align-items:center;gap:8px;">
  <span style="display:inline-flex;align-items:center;justify-content:center;width:18px;height:18px;color:#C8A468;flex-shrink:0;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></span>
  <span>пн-пт 9:00–21:00, сб-вс 10:00–17:00</span>
</p>
<p style="margin:0 0 8px;color:#D8DEE8;font-size:14px;line-height:1.55;display:flex;align-items:center;gap:8px;">
  <span style="display:inline-flex;align-items:center;justify-content:center;width:18px;height:18px;color:#C8A468;flex-shrink:0;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></span>
  <span>Москва, Братиславская ул., 26</span>
</p>
<p style="margin:0;"><a href="/contacts/" style="color:#C8A468;text-decoration:none;font-size:14px;">Все контакты →</a></p>
HTML;
}

function get_new_checklist_html() {
    return <<<HTML
<ul class="de-checklist">
<li><span style="display:inline-flex;align-items:center;justify-content:center;width:18px;height:18px;color:#C8A468;flex-shrink:0;margin-right:6px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span> Телефон: <a href="tel:+79122251788">+7 (912) 22-51-788</a> <span style="color:#667085;font-size:13px;">моб.</span></li>
<li><span style="display:inline-flex;align-items:center;justify-content:center;width:18px;height:18px;color:#C8A468;flex-shrink:0;margin-right:6px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></span> Email: <a href="mailto:natalia@xn----gtbetilkjgn9i.xn--p1ai">natalia@дом-эксперт.рф</a></li>
<li><span style="display:inline-flex;align-items:center;justify-content:center;width:18px;height:18px;color:#C8A468;flex-shrink:0;margin-right:6px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></span> Адрес: Москва, Братиславская ул., 26</li>
<li><span style="display:inline-flex;align-items:center;justify-content:center;width:18px;height:18px;color:#C8A468;flex-shrink:0;margin-right:6px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></span> Время работы: пн-пт 9:00–21:00, сб-вс 10:00–17:00</li>
</ul>
HTML;
}
