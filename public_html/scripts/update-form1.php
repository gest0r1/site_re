<?php
/**
 * Update Fluent Form ID 1 to match our spec (Имя + Телефон + Согласие)
 */
if (PHP_SAPI !== 'cli') { http_response_code(403); exit; }
if (!defined('ABSPATH')) { exit; }

global $wpdb;

$form_id = 1;

$form_fields = [
    'fields' => [
        [
            'index' => 0,
            'element' => 'input_name',
            'attributes' => ['name' => 'names', 'data-type' => 'name-element'],
            'settings' => ['container_class' => '', 'label' => 'Имя'],
            'fields' => [
                'first_name' => [
                    'element' => 'input_text',
                    'attributes' => ['type' => 'text', 'name' => 'first_name', 'value' => '', 'placeholder' => 'Имя'],
                    'settings' => ['container_class' => '', 'label' => 'Имя', 'validation_rules' => ['required' => ['value' => true, 'message' => 'Имя обязательно']]],
                    'editor_options' => ['template' => 'inputText'],
                ],
            ],
            'editor_options' => ['template' => 'nameFields'],
            'uniqElKey' => 'name_1',
        ],
        [
            'index' => 1,
            'element' => 'input_text',
            'attributes' => ['type' => 'tel', 'name' => 'phone', 'value' => '', 'placeholder' => '+7 (___) ___-__-__'],
            'settings' => ['container_class' => '', 'label' => 'Телефон', 'validation_rules' => ['required' => ['value' => true, 'message' => 'Телефон обязателен']]],
            'editor_options' => ['title' => 'Phone', 'template' => 'inputText'],
            'uniqElKey' => 'phone_1',
        ],
        [
            'index' => 2,
            'element' => 'input_checkbox',
            'attributes' => ['type' => 'checkbox', 'name' => 'consent', 'value' => ''],
            'settings' => [
                'container_class' => '',
                'label' => '',
                'admin_field_label' => 'Согласие',
                'validation_rules' => ['required' => ['value' => true, 'message' => 'Необходимо согласие']],
                'advanced_options' => [[
                    'label' => 'Я согласен на обработку <a href="/privacy-policy/" target="_blank">персональных данных</a>',
                    'value' => 'yes', 'calc_value' => '', 'image' => '',
                ]],
            ],
            'editor_options' => ['title' => 'Checkbox', 'template' => 'inputCheckbox'],
            'uniqElKey' => 'consent_1',
        ],
    ],
    'submitButton' => [
        'uniqElKey' => 'submit_1',
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

// Update form
$result = $wpdb->update(
    $wpdb->prefix . 'fluentform_forms',
    [
        'title' => 'Консультация',
        'form_fields' => json_encode($form_fields),
        'appearance_settings' => json_encode(['label_placement' => 'top', 'asterisk_placement' => 'none']),
        'updated_at' => current_time('mysql'),
    ],
    ['id' => $form_id]
);

echo 'Form update: ' . ($result !== false ? 'OK' : 'FAIL') . PHP_EOL;

// Update notifications meta
$notifications = [[
    'name' => 'Email уведомление',
    'subject' => 'Новая заявка: {names}',
    'sendTo' => ['type' => 'email', 'email' => 'natalia@xn----gtbetilkjgn9i.xn--p1ai'],
    'message' => '<h3>Новая заявка</h3><p><b>Имя:</b> {names}<br><b>Телефон:</b> {phone}<br><b>Согласие:</b> {consent}</p>',
    'enabled' => true,
]];
$wpdb->delete($wpdb->prefix . 'fluentform_form_meta', ['form_id' => $form_id, 'meta_key' => 'notifications']);
$wpdb->insert($wpdb->prefix . 'fluentform_form_meta', [
    'form_id' => $form_id,
    'meta_key' => 'notifications',
    'value' => json_encode($notifications),
]);
echo 'Notifications: OK' . PHP_EOL;

// Update settings meta
$wpdb->delete($wpdb->prefix . 'fluentform_form_meta', ['form_id' => $form_id, 'meta_key' => 'settings']);
$wpdb->insert($wpdb->prefix . 'fluentform_form_meta', [
    'form_id' => $form_id,
    'meta_key' => 'settings',
    'value' => json_encode([
        'confirmation' => ['type' => 'message', 'message' => 'Спасибо! Мы свяжемся с вами.', 'samePageFormBehavior' => 'reset_form'],
        'restrictions' => ['requireLogin' => ['enabled' => false]],
    ]),
]);
echo 'Settings: OK' . PHP_EOL;

// Test render
$rendered = do_shortcode('[fluentform id="1"]');
echo 'Render test: ' . (strlen($rendered) > 50 ? 'OK (' . strlen($rendered) . ' chars)' : 'SHORT (' . strlen($rendered) . ' chars)') . PHP_EOL;

echo 'Done.' . PHP_EOL;
