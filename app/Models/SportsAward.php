<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportsAward extends Model
{
    use HasFactory;

    protected $fillable = [
        'award_type_id',
        'game_group_id',
        'sports_bet_id',
        'user_id'
    ];
}
