<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\TeamMember;

try {
    $team = TeamMember::all();
    echo "Count: " . $team->count() . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
