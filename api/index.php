<?php
// 1. Buat folder sementara di /tmp untuk penyimpanan file log/cache
$storagePath = '/tmp/storage';
$directories = [
    $storagePath,
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/views',
    $storagePath . '/framework/sessions',
    $storagePath . '/logs'
];
foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// 2. Paksa Laravel menggunakan konfigurasi Vercel
putenv("VIEW_COMPILED_PATH={$storagePath}/framework/views");
putenv("SESSION_DRIVER=cookie");
putenv("CACHE_STORE=array");
putenv("LOG_CHANNEL=stderr");

// 3. Pindahkan file database ke /tmp agar Vercel bisa membacanya tanpa error
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    copy(__DIR__ . '/../database/database.sqlite', $dbPath);
}
putenv("DB_DATABASE={$dbPath}");

// 4. Lanjutkan menjalankan aplikasi Laravel seperti biasa
require __DIR__ . '/../public/index.php';
