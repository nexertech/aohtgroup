<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Client;

try {
    Client::create([
        'name' => 'Verify Test Client',
        'logo' => 'assets/logo.jpg', // Use an existing image path for test
        'url' => 'http://example.com'
    ]);
    echo "Client verified created.";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
