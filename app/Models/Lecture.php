<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'subject',
        'description',
    ];

    public function ClassForStudy()
    {
        return $this->belongsToMany(ClassForStudy::class, 'learningprograms', 'lecture_id', 'class_id');
    }

}

