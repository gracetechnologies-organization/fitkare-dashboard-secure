<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    protected $fillable = [
        'ex_name',
        'ex_description',
        'ex_duration',
        'ex_thumbnail_url',
        'ex_video_url',
    ];

    public function relations()
    {
        return $this->hasMany(ExerciseRelation::class, 'ex_id');
    }

    public function categories()
    {
        return $this->hasManyThrough(
            Category::class, 
            ExerciseRelation::class, // Intermediate model...
            'ex_id', // Foreign key on the ExerciseRelation model...
            'id', // Local key on the Category model...
            'id', // Local key on the Exercise model...
            'cat_id' // Foreign key on the ExerciseRelation table...
        );
    }

    public function levels()
    {
        return $this->hasManyThrough(
            Level::class, 
            ExerciseRelation::class, // Intermediate model...
            'ex_id', // Foreign key on the ExerciseRelation model...
            'id', // Local key on the Level model...
            'id', // Local key on the Exercise model...
            'level_id' // Foreign key on the ExerciseRelation table...
        );
    }

    public function programs()
    {
        return $this->hasManyThrough(
            Program::class, 
            ExerciseRelation::class, // Intermediate model...
            'ex_id', // Foreign key on the ExerciseRelation model...
            'id', // Local key on the Program model...
            'id', // Local key on the Exercise model...
            'program_id' // Foreign key on the ExerciseRelation table...
        );
    }
}