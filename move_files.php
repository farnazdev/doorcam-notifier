<?php
$sourceDir = '/home3/hoshiser/hoshiserver.ir/gallery';  
$targetDir = '/home3/hoshiser/public_html/uploads'; 

if (!is_dir($sourceDir) || !is_dir($targetDir)) {
    die("❌ Folder not found!");
}

$files = glob($sourceDir . '/*.jpg'); // فقط فایل‌های jpg

foreach ($files as $file) {
    if (is_file($file)) {
        $fileName = basename($file);
        $newPath = $targetDir . '/' . $fileName;

        if (!rename($file, $newPath)) {
            echo "❗ Fail to move {$fileName} <br>";
        }
    }
}


