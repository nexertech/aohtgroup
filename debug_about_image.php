<?php
use App\Models\CompanyInfo;
use Illuminate\Support\Facades\Storage;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

echo "Checking Company Info...\n";
$company = CompanyInfo::first();

if (!$company) {
    echo "No Company Info record found.\n";
    exit;
}

echo "About Image DB Value: " . ($company->about_image ?? 'NULL') . "\n";

if ($company->about_image) {
    $relativePath = $company->about_image;
    $publicPath = public_path('storage/' . $relativePath);
    $storagePath = storage_path('app/public/' . $relativePath);

    echo "Public Path: $publicPath\n";
    echo "File exists in Public? " . (file_exists($publicPath) ? 'Yes' : 'No') . "\n";

    echo "Storage Path: $storagePath\n";
    echo "File exists in Storage? " . (file_exists($storagePath) ? 'Yes' : 'No') . "\n";

    // Check link
    $linkPath = public_path('storage');
    echo "Public Storage Link Exists? " . (file_exists($linkPath) ? 'Yes' : 'No') . "\n";
    if (is_link($linkPath)) {
        echo "It is a symlink pointing to: " . readlink($linkPath) . "\n";
    } else {
        echo "It is NOT a symlink.\n";
    }
} else {
    echo "No image path stored in DB.\n";
}
