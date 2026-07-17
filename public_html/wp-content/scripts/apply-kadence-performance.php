<?php
/**
 * Apply approved Kadence General → Performance settings.
 */

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit("CLI only\n");
}

if (!defined('ABSPATH')) {
    exit("WordPress context required (run via wp-cli eval-file)\n");
}

echo "=== Kadence Performance Settings Apply ===\n\n";

$mods = get_theme_mods();
if (!is_array($mods)) {
    $mods = [];
}

$target = [
    'microdata' => false,
    'theme_json_mode' => false,
    'enable_scroll_to_id' => true,
    'lightbox' => false,
    'load_fonts_local' => true,
    'preload_fonts_local' => true,
    'enable_preload' => false,
    'disable_sitemap' => true,
];

echo "--- BEFORE ---\n";
foreach ($target as $key => $_) {
    $value = $mods[$key] ?? '(not set)';
    echo $key . ': ' . (is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : var_export($value, true)) . "\n";
}

foreach ($target as $key => $value) {
    set_theme_mod($key, $value);
}

echo "\n--- AFTER ---\n";
$after = get_theme_mods();
$ok = true;
foreach ($target as $key => $expected) {
    $actual = $after[$key] ?? null;
    $pass = json_encode($actual, JSON_UNESCAPED_UNICODE) === json_encode($expected, JSON_UNESCAPED_UNICODE);
    echo $key . ': ' . ($pass ? '✅' : '❌') . "\n";
    $ok = $ok && $pass;
}

if (!$ok) {
    exit(1);
}

echo "\n✅ All Performance settings applied and verified.\n";
