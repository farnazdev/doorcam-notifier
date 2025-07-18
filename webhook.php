<?php
$bot_token = 'XXX';
$status_file = "/home/farnaz/public_html/gallery/status.txt";

$content = file_get_contents("php://input");
file_put_contents("log.txt", $content . PHP_EOL, FILE_APPEND);

$update = json_decode($content, true);

if (isset($update['message'])) {
    $chat_id = $update['message']['chat']['id'];
    $text = trim($update['message']['text']);

    if ($text == '/start') {
        sendKeyboardMessage($chat_id);
    } elseif ($text == '❌ Disable') {
        file_put_contents($status_file, 'off');
        sendMessage($chat_id, "⛔ سرویس غیرفعال شد.");
        sendKeyboardMessage($chat_id);
    } elseif ($text == '✅ Enable') {
        file_put_contents($status_file, 'on');
        sendMessage($chat_id, "✅ سرویس فعال شد.");
        sendKeyboardMessage($chat_id);
    }
}

function sendKeyboardMessage($chat_id) {
    global $bot_token, $status_file;

    
    if (!file_exists($status_file)) {
        file_put_contents($status_file, "off");
    }

    $status = trim(file_get_contents($status_file));
    $button_text = ($status === "on") ? "❌ Disable" : "✅ Enable";

    $keyboard = [
        'keyboard' => [
            [['text' => $button_text]]
        ],
        'resize_keyboard' => true,
        'one_time_keyboard' => true
    ];

    $data = [
        'chat_id' => $chat_id,
        'text' => "🔧 وضعیت فعلی سرویس: $status\n\nبرای تغییر وضعیت روی دکمه زیر بزن:",
        'reply_markup' => json_encode($keyboard)
    ];

    sendRequest($data);
}

function sendMessage($chat_id, $text) {
    global $bot_token;
    $data = [
        'chat_id' => $chat_id,
        'text' => $text
    ];
    sendRequest($data);
}

function sendRequest($data) {
    global $bot_token;
    $url = "https://tapi.bale.ai/bot$bot_token/sendMessage";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    file_put_contents("response.txt", $response . PHP_EOL, FILE_APPEND);
}
?>
