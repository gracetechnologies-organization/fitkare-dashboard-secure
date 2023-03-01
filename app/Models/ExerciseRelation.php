<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseRelation extends Model
{
    use HasFactory;
    protected $fillable = [
        'ex_id',
        'cat_id',
        'level_id',
        'program_id',
        'from_day',
        'till_day',
    ];
}
