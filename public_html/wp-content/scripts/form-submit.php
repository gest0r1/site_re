<?php
header('Content-Type: application/json; charset=utf-8');

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
    exit;
}

// --- Translate action codes to Russian ---
$action_map = [
    'estimate'       => 'Оценка квартиры',
    'consult'        => 'Консультация',
    'sell_consult'   => 'Консультация продавца',
    'buyer_consult'  => 'Консультация покупателя',
    'diagnostic'     => 'Диагностика потерь',
    'prepare'        => 'Подготовка к продаже',
    'documents'      => 'Документы',
    'showings'       => 'Показы',
    'negotiation'    => 'Переговоры',
    'taxes'          => 'Налоги',
    'alternative'    => 'Альтернативная сделка',
    'deploy_test'    => 'Тест',
];
$action_label = $action_map[$input['action'] ?? ''] ?: ($input['action'] ?? 'Консультация');

// --- Fields with Russian labels ---
$fields_map = [
    'topic'         => 'Тема',
    'question'      => 'Вопрос',
    'message'       => 'Сообщение',
    'comment'       => 'Комментарий',
    'address'       => 'Адрес',
    'budget'        => 'Бюджет',
    'property_type' => 'Тип жилья',
    'building_type' => 'Тип дома',
    'floor'         => 'Этаж',
    'total_floors'  => 'Этажность',
    'area'          => 'Площадь',
    'rooms'         => 'Комнат',
    'condition'     => 'Состояние',
];

$page     = htmlspecialchars($input['page'] ?? '—', ENT_QUOTES, 'UTF-8');
$page_url = htmlspecialchars($input['page_url'] ?? '', ENT_QUOTES, 'UTF-8');
$name     = htmlspecialchars($input['name'] ?? '—', ENT_QUOTES, 'UTF-8');
$phone    = htmlspecialchars($input['phone'] ?? '—', ENT_QUOTES, 'UTF-8');

// Extra fields (topic, question, etc.) — Russian labels
$extras = '';
foreach ($fields_map as $key => $label) {
    if (!empty($input[$key]) && !in_array($key, ['building_type','floor','total_floors','area','rooms','condition'])) {
        $val = htmlspecialchars($input[$key], ENT_QUOTES, 'UTF-8');
        $extras .= "\n$label: $val";
    }
}

// Params block (estimate form) — Russian labels
$params_block = '';
foreach (['building_type','floor','total_floors','area','rooms','condition'] as $k) {
    if (!empty($input[$k])) {
        $label = $fields_map[$k];
        $val = htmlspecialchars($input[$k], ENT_QUOTES, 'UTF-8');
        if ($k === 'area') $val .= ' м²';
        $params_block .= "\n• $label: $val";
    }
}

// Build message
$message = "📩 <b>Новая заявка</b>\n"
    . "━━━━━━━━━━━━━━━\n"
    . "<b>Страница:</b> {$page}\n"
    . "<b>Тип:</b> {$action_label}\n"
    . "━━━━━━━━━━━━━━━\n"
    . "<b>Имя:</b> {$name}\n"
    . "<b>Телефон:</b> {$phone}"
    . ($extras ? "\n{$extras}" : '')
    . ($params_block ? "\n\n<b>Параметры квартиры:</b>{$params_block}" : '')
    . "\n━━━━━━━━━━━━━━━\n"
    . "<i>Отправлено с дом-эксперт.рф</i>";

// --- Queue ---
$queue_file = '/home/g/gest0rmail/form_queue.json';
$queue = file_exists($queue_file) ? (json_decode(file_get_contents($queue_file), true) ?? []) : [];
$queue[] = [
    'created_at' => date('Y-m-d H:i:s'),
    'message'    => $message,
    'sent'       => false,
];
if (count($queue) > 1000) $queue = array_slice($queue, -1000);
file_put_contents($queue_file, json_encode($queue, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
chmod($queue_file, 0644);

echo json_encode(['success' => true, 'message' => 'Заявка принята']);
