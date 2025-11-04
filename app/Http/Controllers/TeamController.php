<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::orderBy('points', 'desc')
                    ->orderBy('goals_scored', 'desc') // criterio secundario
                    ->paginate(10);

        return view('teams.index', compact('teams'));
    }


    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'shield' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['name']);

        if ($request->hasFile('shield')) {
            $data['shield'] = $request->file('shield')->store('shields', 'public');
        }

        Team::create($data);

        return redirect()->route('teams.index')->with('success', 'Team created successfully.');
    }

    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'shield' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['name']);

        if ($request->hasFile('shield')) {
            if ($team->shield) {
                Storage::disk('public')->delete($team->shield);
            }
            $data['shield'] = $request->file('shield')->store('shields', 'public');
        }

        $team->update($data);

        return redirect()->route('teams.index')->with('success', 'Team updated successfully.');
    }

    public function destroy(Team $team)
    {
        if ($team->shield) {
            Storage::disk('public')->delete($team->shield);
        }

        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Team deleted successfully.');
    }
}
