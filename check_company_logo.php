<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\CompanyInfo;

try {
    $companies = CompanyInfo::all();
    echo "Count: " . $companies->count() . "\n";
    foreach ($companies as $c) {
        echo "ID: " . $c->id . "\n";
        echo "Name: " . $c->company_name . "\n";
        echo "Logo Raw: " . $c->logo . "\n";
        echo "--------------------------\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
