<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'local',
        'value',
        'amount',
        'date_award',
    ];
    protected $dates = ['date_award'];
}
