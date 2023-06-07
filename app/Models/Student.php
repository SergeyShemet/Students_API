<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'class_id'
    ];

    public function ClassForStudy() {
        return $this->belongsTo(ClassForStudy::class, 'class_id');
    }


}
