<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DailyActivity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'position'];

    protected $casts = ['position' => 'integer'];

    public function records(): HasMany
    {
        return $this->hasMany(Record::class);
    }
}
