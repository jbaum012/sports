<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $casts = [
        'starts_at' => 'datetime',
    ];

    public function currentWeek()
    {
        return $this->starts_at->diffInWeeks(Carbon::now()) + 1;
    }
}
