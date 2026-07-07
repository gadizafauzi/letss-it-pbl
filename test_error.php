<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $a = "string";
    $val = $a->schoolClass->class_name ?? 'N/A';
    echo "Line 145 passed.\n";
} catch (\Throwable $e) {
    echo "Line 145 Failed: " . $e->getMessage() . "\n";
}

try {
    $a = "string";
    $val = $a->class_id;
    echo "Line 147 passed.\n";
} catch (\Throwable $e) {
    echo "Line 147 Failed: " . $e->getMessage() . "\n";
}
