<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Record extends Model
{
    use HasFactory;

    protected $fillable = ['daily_activity_id', 'sets', 'reps'];

    protected $casts = ['sets' => 'integer', 'reps' => 'integer'];

    public function activity_type(): BelongsTo
    {
        return $this->belongsTo(DailyActivity::class);
    }
}
