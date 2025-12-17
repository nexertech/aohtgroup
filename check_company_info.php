<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\CompanyInfo;

try {
    $info = CompanyInfo::all();
    echo "Count: " . $info->count() . "\n";
    foreach ($info as $c) {
        echo "ID: " . $c->id . " - Name: " . $c->company_name . "\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
