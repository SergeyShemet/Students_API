<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningProgram extends Model
{
    use HasFactory;

    protected $table = 'learningprograms';
    public $timestamps = false;
}
