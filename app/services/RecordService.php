<?php

namespace App\services;

use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class RecordService
{
    public function filter(array $params) {
        $startDate = null;
        if (!empty($params['startDate'])) {
            try {
                $startDate = Carbon::parse($params['startDate'])->startOfDay();
            } catch (Exception $ex) {
                //
            }
        }
        $endDate = null;
        if (!empty($params['endDate'])) {
            try {
                $endDate = Carbon::parse($params['endDate'])->endOfDay();
            } catch (Exception $ex) {
                //
            }
        }

        return Record::query()
            ->join('daily_activities', 'daily_activity_id', '=', 'daily_activities.id')
            ->select(['records.*', 'daily_activities.name as daily_activity_name'])
            ->where('user_id', '=', $params['user_id'])
            ->when(!empty($params['activity']), function (Builder $builder) use ($params) {
                $builder->where('daily_activity_id', $params['activity']);
            })
            ->when($startDate, function (Builder $builder) use ($startDate) {
                $builder->where('records.created_at', '>', $startDate);
            })
            ->when($endDate, function (Builder $builder) use ($endDate) {
                $builder->where('records.created_at', '<', $endDate);
            });
    }
}
