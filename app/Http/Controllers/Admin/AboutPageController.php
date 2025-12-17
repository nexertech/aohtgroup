<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function index()
    {
        // Assuming singleton pattern for CompanyInfo
        $companyInfo = CompanyInfo::first();
        if (!$companyInfo) {
            $companyInfo = new CompanyInfo();
        }

        return view('admin.pages.about', compact('companyInfo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'history' => 'nullable|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);

        $companyInfo = CompanyInfo::first();

        // Prepare data
        $data = $request->only(['mission', 'vision', 'history']);

        // Handle Image Upload
        if ($request->hasFile('about_image')) {
            // Delete old image if exists
            if ($companyInfo && $companyInfo->about_image && file_exists(public_path($companyInfo->about_image))) {
                @unlink(public_path($companyInfo->about_image));
            }

            // Upload new image
            $imageName = time() . '_about.' . $request->about_image->extension();
            $request->about_image->move(public_path('images/company'), $imageName);
            $data['about_image'] = 'images/company/' . $imageName;
        }

        if (!$companyInfo) {
            CompanyInfo::create($data);
        } else {
            $companyInfo->update($data);
        }

        return redirect()->route('admin.pages.about')->with('success', 'About Page content updated successfully.');
    }
}
