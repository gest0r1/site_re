<?php
/**
 * Create Fluent Form: "Консультация" (name + phone + consent)
 *
 * Usage:
 *   php8.3 ~/bin/wp-cli.phar --path=PATH eval-file scripts/create-consultation-form.php
 */

if (PHP_SAPI !== 'cli') { http_response_code(403); exit("CLI only\n"); }
if (!defined('ABSPATH')) { exit("WordPress context required\n"); }

$_SERVER['HTTP_HOST'] = $_SERVER['HTTP_HOST'] ?? 'xn----gtbetilkjgn9i.xn--p1ai';
global $wpdb;

// Check if form already exists
$existing = $wpdb->get_var("SELECT id FROM {$wpdb->prefix}fluentform_forms WHERE title = 'Консультация' LIMIT 1");
if ($existing) {
    WP_CLI::line("Form 'Консультация' already exists (ID: {$existing}). Updating fields.");
    $form_id = $existing;
} else {
    // Create new form entry
    $wpdb->insert("{$wpdb->prefix}fluentform_forms", [
        'title' => 'Консультация',
        'status' => 'published',
        'created_at' => current_time('mysql'),
        'updated_at' => current_time('mysql'),
    ]);
    $form_id = $wpdb->insert_id;
    WP_CLI::line("Form 'Консультация' created (ID: {$form_id}).");
}

// Build form fields (same structure as Contact Form Demo)
$form_fields = [
    'fields' => [
        [
            'index' => 0,
            'element' => 'input_name',
            'attributes' => ['name' => 'names', 'data-type' => 'name-element'],
            'settings' => [
                'container_class' => '',
                'admin_field_label' => 'Имя',
                'conditional_logics' => [],
                'label' => 'Имя',
            ],
            'fields' => [
                'first_name' => [
                    'element' => 'input_text',
                    'attributes' => ['type' => 'text', 'name' => 'first_name', 'value' => '', 'placeholder' => 'Имя'],
                    'settings' => [
                        'container_class' => '',
                        'label' => 'Имя',
                        'validation_rules' => ['required' => ['value' => true, 'message' => 'Имя обязательно']],
                    ],
                    'editor_options' => ['template' => 'inputText'],
                ],
            ],
            'editor_options' => ['template' => 'nameFields'],
            'uniqElKey' => 'name_' . $form_id,
        ],
        [
            'index' => 1,
            'element' => 'input_text',
            'attributes' => ['type' => 'tel', 'name' => 'phone', 'value' => '', 'placeholder' => '+7 (___) ___-__-__'],
            'settings' => [
                'container_class' => '',
                'label' => 'Телефон',
                'validation_rules' => ['required' => ['value' => true, 'message' => 'Телефон обязателен']],
            ],
            'editor_options' => ['title' => 'Phone', 'template' => 'inputText'],
            'uniqElKey' => 'phone_' . $form_id,
        ],
        [
            'index' => 2,
            'element' => 'input_checkbox',
            'attributes' => ['type' => 'checkbox', 'name' => 'consent', 'value' => ''],
            'settings' => [
                'container_class' => '',
                'label' => '',
                'admin_field_label' => 'Согласие на обработку данных',
                'validation_rules' => ['required' => ['value' => true, 'message' => 'Необходимо согласие']],
                'advanced_options' => [[
                    'label' => 'Я согласен на обработку <a href="/privacy-policy/" target="_blank">персональных данных</a>',
                    'value' => 'yes', 'calc_value' => '', 'image' => '',
                ]],
            ],
            'editor_options' => ['title' => 'Checkbox', 'template' => 'inputCheckbox'],
            'uniqElKey' => 'consent_' . $form_id,
        ],
    ],
    'submitButton' => [
        'uniqElKey' => 'submit_' . $form_id,
        'element' => 'button',
        'attributes' => ['type' => 'submit'],
        'settings' => [
            'align' => 'center',
            'button_style' => 'default',
            'button_size' => 'lg',
            'background_color' => '#F5A623',
            'color' => '#1A202C',
            'button_ui' => ['type' => 'default', 'text' => 'Получить консультацию'],
        ],
        'editor_options' => ['template' => 'submitButton'],
    ],
];

// Update form fields
$wpdb->update("{$wpdb->prefix}fluentform_forms", [
    'form_fields' => json_encode($form_fields),
    'appearance_settings' => json_encode(['label_placement' => 'top', 'asterisk_placement' => 'none']),
    'updated_at' => current_time('mysql'),
], ['id' => $form_id]);

// Save notifications as meta
$notifications = [[
    'name' => 'Email уведомление',
    'subject' => 'Новая заявка с дом-эксперт.рф: {names}',
    'sendTo' => ['type' => 'email', 'email' => 'natalia@xn----gtbetilkjgn9i.xn--p1ai'],
    'message' => '<h3>Новая заявка с дом-эксперт.рф</h3><p><b>Имя:</b> {names}<br><b>Телефон:</b> {phone}<br><b>Согласие:</b> {consent}</p>',
    'enabled' => true,
]];
$wpdb->delete("{$wpdb->prefix}fluentform_form_meta", ['form_id' => $form_id, 'meta_key' => 'notifications']);
$wpdb->insert("{$wpdb->prefix}fluentform_form_meta", [
    'form_id' => $form_id,
    'meta_key' => 'notifications',
    'value' => json_encode($notifications),
]);

// Save default settings
$wpdb->delete("{$wpdb->prefix}fluentform_form_meta", ['form_id' => $form_id, 'meta_key' => 'settings']);
$wpdb->insert("{$wpdb->prefix}fluentform_form_meta", [
    'form_id' => $form_id,
    'meta_key' => 'settings',
    'value' => json_encode([
        'confirmation' => ['type' => 'message', 'message' => 'Спасибо! Мы свяжемся с вами в ближайшее время.', 'samePageFormBehavior' => 'reset_form'],
        'restrictions' => ['requireLogin' => ['enabled' => false]],
    ]),
]);

// Ensure post exists
$existing_post = $wpdb->get_var($wpdb->prepare(
    "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'fluentform' AND post_title = 'Консультация' LIMIT 1"
));
if (!$existing_post) {
    wp_insert_post([
        'post_title' => 'Консультация',
        'post_type' => 'fluentform',
        'post_status' => 'publish',
        'post_content' => '',
    ]);
}

WP_CLI::success("Form 'Консультация' ready (ID: {$form_id}).");
echo "FORM_ID={$form_id}\n";
