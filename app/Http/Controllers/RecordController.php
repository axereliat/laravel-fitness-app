<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordPostRequest;
use App\Models\DailyActivity;
use App\Models\Record;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class RecordController extends Controller
{
    public function index(Request $request)
    {

        $activities = DailyActivity::all();

        $startDate = null;
        if ($request->query('startDate')) {
            try {
                $startDate = Carbon::parse($request->query('startDate'))->startOfDay();
            } catch (Exception $ex) {
                //
            }
        }
        $endDate = null;
        if ($request->query('endDate')) {
            try {
                $endDate = Carbon::parse($request->query('endDate'))->endOfDay();
            } catch (Exception $ex) {
                //
            }
        }

        $records = Record::query()
            ->join('daily_activities', 'daily_activity_id', '=', 'daily_activities.id')
            ->select(['records.*', 'daily_activities.name as daily_activity_name'])
            ->where('user_id', '=', Auth::id())
            ->when($request->query('activity'), function (Builder $builder) use ($request) {
                $builder->where('daily_activity_id', $request->query('activity'));
            })
            ->when($startDate, function (Builder $builder) use ($startDate) {
                $builder->where('records.created_at', '>', $startDate);
            })
            ->when($endDate, function (Builder $builder) use ($endDate) {
                $builder->where('records.created_at', '<', $endDate);
            })
            ->paginate(5);

        return view('records.list-records', ['records' => $records, 'activities' => $activities]);
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

    public function destroy(Record $record)
    {
        $record->delete();

        return redirect('/records')->with('success', 'Record was successfully deleted.');
    }
}
