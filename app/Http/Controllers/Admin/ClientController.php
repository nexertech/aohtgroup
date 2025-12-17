<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(10);
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            'url' => 'nullable|url',
        ]);

        $input = $request->all();

        if ($request->hasFile('logo')) {
            $imageName = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('images/clients'), $imageName);
            $input['logo'] = 'images/clients/' . $imageName;
        }

        Client::create($input);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            'url' => 'nullable|url',
        ]);

        $input = $request->all();

        if ($request->hasFile('logo')) {
            if ($client->logo && file_exists(public_path($client->logo))) {
                unlink(public_path($client->logo));
            }
            $imageName = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('images/clients'), $imageName);
            $input['logo'] = 'images/clients/' . $imageName;
        } else {
            unset($input['logo']);
        }

        $client->update($input);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client updated successfully');
    }

    public function destroy(Client $client)
    {
        if ($client->logo && file_exists(public_path($client->logo))) {
            unlink(public_path($client->logo));
        }
        $client->delete();

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client deleted successfully');
    }
}
