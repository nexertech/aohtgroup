<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::latest()->paginate(10);
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            'issue_date' => 'nullable|date',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/certificates'), $imageName);
            $input['image'] = 'images/certificates/' . $imageName;
        }

        Certificate::create($input);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Certificate created successfully.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            'issue_date' => 'nullable|date',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            if ($certificate->image && file_exists(public_path($certificate->image))) {
                unlink(public_path($certificate->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/certificates'), $imageName);
            $input['image'] = 'images/certificates/' . $imageName;
        } else {
            unset($input['image']);
        }

        $certificate->update($input);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Certificate updated successfully');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->image && file_exists(public_path($certificate->image))) {
            unlink(public_path($certificate->image));
        }
        $certificate->delete();

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Certificate deleted successfully');
    }
}
