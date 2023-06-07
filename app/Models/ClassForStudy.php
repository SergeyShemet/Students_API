<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassForStudy extends Model
{
    use HasFactory;

    protected $table = 'classes';
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function Students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function Lectures()
    {
        return $this->belongsToMany(Lecture::class, 'learningprograms', 'class_id', 'lecture_id');
    }

}
