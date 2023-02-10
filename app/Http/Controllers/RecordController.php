<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordPostRequest;
use App\Models\DailyActivity;
use App\Models\Record;
use DB;
use Illuminate\Support\Facades\Auth;
use Request;

class RecordController extends Controller
{
    public function index()
    {
        $records = DB::table('records')
            ->join('daily_activities', 'daily_activity_id', '=', 'daily_activities.id')
            ->select(['records.*', 'daily_activities.name as daily_activity_name'])
            ->where('user_id', '=', Auth::id())
            ->get();

        return view('records.list-records', ['records' => $records]);
    }

    public function create()
    {
        $activities = DailyActivity::all();

        return view('records.create-record', ['activities' => $activities]);
    }

    public function store(RecordPostRequest $request)
    {
        $record = Auth::user()->records()->create($request->validated());

        return redirect('/records')->with('success', 'Your record was successfully saved.');
    }

    public function edit(Record $record)
    {
        $activities = DailyActivity::all();

        return view('records.edit-record', ['activities' => $activities, 'record' => $record]);
    }

    public function update(RecordPostRequest $request, Record $record)
    {
        $record->update($request->validated());

        return redirect('/records')->with('success', 'Your record was successfully updated.');
    }

    public function destroy(Record $record) {
        $record->delete();

        return redirect('/records')->with('success', 'Record was successfully deleted.');
    }
}
