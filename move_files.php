<?php
$sourceDir = '/home/farnaz/farnazboroumand.ir/gallery';  
$targetDir = '/home/farnaz/public_html/uploads'; 

if (!is_dir($sourceDir) || !is_dir($targetDir)) {
    die("❌ Folder not found!");
}

$files = glob($sourceDir . '/*.jpg'); // just jpg

foreach ($files as $file) {
    if (is_file($file)) {
        $fileName = basename($file);
        $newPath = $targetDir . '/' . $fileName;

        if (!rename($file, $newPath)) {
            echo "❗ Fail to move {$fileName} <br>";
        }
    }
}


