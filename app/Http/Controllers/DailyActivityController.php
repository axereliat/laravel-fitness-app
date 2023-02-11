<?php

namespace App\Http\Controllers;

use App\Models\DailyActivity;
use Illuminate\Http\Request;

class DailyActivityController extends Controller
{
    public function index() {
        $activities = DailyActivity::all();

        return view('activities.list-activities', ['activities' => $activities]);
    }

    public function create() {
        $activities = DailyActivity::all();

        return view('activities.create-activity', ['activities' => $activities]);
    }

    public function store(Request $request) {
        $position = DailyActivity::latest()->first()->position + 1;

        DailyActivity::create([
            'name' => $request->name,
            'position' => $position
        ]);

        return redirect('/activities')->with('success', 'Activity was successfully created');
    }

    public function edit(DailyActivity $activity) {
        return view('activities.edit-activity', ['activity' => $activity]);
    }

    public function update(Request $request, DailyActivity $activity) {
        $activity->name = $request->name;
        $activity->save();

        return redirect('/activities')->with('success', 'Activity was successfully updated');
    }

    public function destroy(DailyActivity $activity) {
        $activity->delete();

        return redirect('/activities')->with('success', 'Activity was successfully deleted.');
    }
}
