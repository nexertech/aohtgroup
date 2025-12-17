<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Client;

try {
    $clients = Client::all();
    echo "Count: " . $clients->count() . "\n";
    foreach ($clients as $c) {
        echo "ID: " . $c->id . " - Name: " . $c->name . " - Logo: " . $c->logo . "\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
