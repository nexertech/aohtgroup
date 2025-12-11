<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teamMembers = TeamMember::orderBy('sequence')->latest()->paginate(10);
        return view('admin.team_members.index', compact('teamMembers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.team_members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:150',
            'designation' => 'nullable|string|max:150',
            'bio' => 'nullable|string',
            'photo' => 'nullable|string|max:255', // Assuming photo URL or path input for now
            'facebook' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'sequence' => 'integer',
        ]);

        TeamMember::create($validatedData);

        return redirect()->route('admin.team-members.index')->with('success', 'Team Member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TeamMember $teamMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeamMember $teamMember)
    {
        return view('admin.team_members.edit', compact('teamMember'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeamMember $teamMember)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:150',
            'designation' => 'nullable|string|max:150',
            'bio' => 'nullable|string',
            'photo' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'sequence' => 'integer',
        ]);

        $teamMember->update($validatedData);

        return redirect()->route('admin.team-members.index')->with('success', 'Team Member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return redirect()->route('admin.team-members.index')->with('success', 'Team Member deleted successfully.');
    }
}
