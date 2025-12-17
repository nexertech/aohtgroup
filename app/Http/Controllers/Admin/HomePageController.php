<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomePageController extends Controller
{
    public function index()
    {
        // Assuming we use the latest or first company info record as the main one
        $companyInfo = CompanyInfo::first();
        if (!$companyInfo) {
            $companyInfo = new CompanyInfo();
        }

        return view('admin.pages.home', compact('companyInfo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'about' => 'nullable|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3072',
        ]);

        $companyInfo = CompanyInfo::first();

        $input = $request->only(['about']);

        if (!$companyInfo) {
            if ($request->hasFile('about_image')) {
                $imageName = time() . '.' . $request->about_image->extension();
                $request->about_image->move(public_path('images/company'), $imageName);
                $input['about_image'] = 'images/company/' . $imageName;
            }
            $companyInfo = CompanyInfo::create($input);
        } else {
            if ($request->hasFile('about_image')) {
                // Delete old image if exists
                if ($companyInfo->about_image && file_exists(public_path($companyInfo->about_image))) {
                    // unlink(public_path($companyInfo->about_image)); 
                    // Warning: unlink might fail if path is partial or permissions
                }

                $imageName = time() . '.' . $request->about_image->extension();
                $request->about_image->move(public_path('images/company'), $imageName);
                $input['about_image'] = 'images/company/' . $imageName;
            }
            $companyInfo->update($input);
        }

        return redirect()->route('admin.pages.home')->with('success', 'Home Page content updated successfully.');
    }
}
