<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DailyDictionary extends Model
{
    use HasFactory;

    public function dailyWords(): HasMany
    {
        return $this->hasMany(DailyWord::class);
    }
}
