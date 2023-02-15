<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordPostRequest;
use App\Models\DailyActivity;
use App\Models\Record;
use App\services\RecordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\SimpleExcel\SimpleExcelWriter;

class RecordController extends Controller
{
    public function index(Request $request, RecordService $recordService)
    {
        $activities = DailyActivity::all();

        $params = $request->all() + ['user_id' => Auth::id()];

        $records = $recordService->filter($params)->paginate(5);

        return view('records.list-records', [
            'records' => $records,
            'activities' => $activities,
            'params' => $params
        ]);
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

    public function export(Request $request, RecordService $recordService) {
        $writer = SimpleExcelWriter::streamDownload('records-export.xlsx');

        $params = $request->all() + ['user_id' => Auth::id()];

        $records = $recordService->filter($params)->with('activity_type')->get();

        foreach ($records as $i => $record) {
            $writer->addRow([
                'exercise' => $record->daily_activity_name ?? '',
                'sets' => $record->sets,
                'reps' => $record->reps
            ]);

            if ($i % 1000 === 0) {
                flush(); // Flush the buffer every 1000 rows
            }
        }

        $writer->toBrowser();

        return redirect('/records');
    }
}
