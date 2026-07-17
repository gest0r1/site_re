<?php
/**
 * Apply approved Kadence General → Back to Top settings.
 */

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit("CLI only\n");
}

if (!defined('ABSPATH')) {
    exit("WordPress context required (run via wp-cli eval-file)\n");
}

echo "=== Kadence Back to Top Settings Apply ===\n\n";

$mods = get_theme_mods();
if (!is_array($mods)) {
    $mods = [];
}

$target = [
    'scroll_up' => true,
    'scroll_up_icon' => 'arrow-up',
    'scroll_up_side' => 'right',
    'scroll_up_style' => 'outline',
    'scroll_up_visiblity' => [
        'desktop' => true,
        'tablet' => true,
        'mobile' => true,
    ],
    'scroll_up_icon_size' => [
        'size' => [
            'desktop' => '1.2',
            'tablet' => '1.2',
            'mobile' => '1',
        ],
        'unit' => [
            'desktop' => 'em',
            'tablet' => 'em',
            'mobile' => 'em',
        ],
    ],
    'scroll_up_side_offset' => [
        'size' => [
            'desktop' => '30',
            'tablet' => '30',
            'mobile' => '20',
        ],
        'unit' => [
            'desktop' => 'px',
            'tablet' => 'px',
            'mobile' => 'px',
        ],
    ],
    'scroll_up_bottom_offset' => [
        'size' => [
            'desktop' => '30',
            'tablet' => '30',
            'mobile' => '24',
        ],
        'unit' => [
            'desktop' => 'px',
            'tablet' => 'px',
            'mobile' => 'px',
        ],
    ],
    'scroll_up_padding' => [
        'size' => [
            'desktop' => ['0.4', '0.4', '0.4', '0.4'],
        ],
        'unit' => [
            'desktop' => 'em',
        ],
    ],
    'scroll_up_color' => '#10233F',
    'scroll_up_color_hover' => '#C8A468',
    'scroll_up_border' => [
        'desktop' => [
            'width' => 1,
            'unit' => 'px',
            'style' => 'solid',
            'color' => '#D8DEE8',
        ],
    ],
    'scroll_up_border_colors' => [
        'color' => '#D8DEE8',
        'hover' => '#C8A468',
    ],
    'scroll_up_radius' => [
        'size' => [
            'desktop' => '12',
        ],
        'unit' => [
            'desktop' => 'px',
        ],
    ],
];

echo "--- BEFORE ---\n";
foreach (array_keys($target) as $key) {
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

echo "\n✅ All Back to Top settings applied and verified.\n";
