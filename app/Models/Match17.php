<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match17 extends Model
{
    use HasFactory;

    protected $table = 'matches';

    protected $fillable = [
        'team1',
        'team2',
        'score',
        'date',
        'time',
        'type',
    ];
}
