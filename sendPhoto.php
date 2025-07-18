<?php
include "move_files.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$ftp_folder = '/home3/hoshiser/public_html/uploads'; 
$log_file = "/home3/hoshiser/public_html/gallery/gallery_log.txt";
$status_file = "/home3/hoshiser/public_html/gallery/status.txt";

$bot_token = "1284542720:noKHklmnAn63mgdYeEfrRpdf7GBYL4vivG4PVOuX";  
$chat_id = "5994718214"; 
//
$lock_file = "/tmp/sendphoto.lock";
if (file_exists($lock_file) && (time() - filemtime($lock_file) < 60)) {
    exit("⛔ Already running");
}
touch($lock_file);
//
if (!file_exists($status_file) || trim(file_get_contents($status_file)) !== 'on') {
    exit; 
}

if (!is_dir($ftp_folder)) {
    die("❌ Folder not found! ");
}

if (!file_exists($log_file)) {
    file_put_contents($log_file, "");
}

$previous_files = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
$current_files = array_diff(scandir($ftp_folder), array('.', '..'));
$new_files = array_diff($current_files, $previous_files);

if (!empty($new_files)) {
    foreach ($new_files as $file) {
        $msg = "✅ درب پارکینگ باز شد:\n\n";
        $file_url = "http://hoshiserver.ir/uploads/" . urlencode($file);
        $msg .= date("Y-m-d H:i:s");
        sendMessage($msg, $file_url, $chat_id, $bot_token);
    } 
    file_put_contents($log_file, implode("\n", $current_files));
} else {
    echo "ℹ️ No new file found. ";
}

function sendMessage($caption, $photo_url, $chat_id, $bot_token) {
    $url = "https://tapi.bale.ai/bot$bot_token/sendPhoto?chat_id=$chat_id&photo=" . urlencode($photo_url) . "&caption=" . urlencode($caption);
    
    $response = @file_get_contents($url);
    if ($response === false) {
        file_put_contents("bale_errors.txt", date("Y-m-d H:i:s") . " ❌ Failed to send $photo_url\n", FILE_APPEND);
    } else {
        file_put_contents("bale_errors.txt", date("Y-m-d H:i:s") . " ✅ Sent $photo_url\n", FILE_APPEND);
    }
}


unlink($lock_file);
?>
