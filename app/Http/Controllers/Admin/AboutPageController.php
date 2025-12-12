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
        ]);

        $companyInfo = CompanyInfo::first();

        if (!$companyInfo) {
            $companyInfo = CompanyInfo::create($request->all());
        } else {
            $companyInfo->update($request->only(['mission', 'vision', 'history']));
        }

        return redirect()->route('admin.pages.about')->with('success', 'About Page content updated successfully.');
    }
}
