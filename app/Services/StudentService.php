<?php
declare(strict_types=1);
namespace App\Services;

use App\Models\Student;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StudentService {

    public function getAllStudents(): Collection {
        $students = Student::all();
        return $students->pluck('name','id');
    }

    public function getStudent(int $id): Student {
        $student = Student::with('ClassForStudy.Lectures')->find($id);
        if (!isset($student)) {
            throw new ModelNotFoundException("ID не найден в базе данных.");
        }
        if (!is_null($student->ClassForStudy))   {
            $student->class = $student->ClassForStudy->name;
            $student->lectures = $student->ClassForStudy->Lectures->pluck('subject','id');
        } else {
            $student->class = null;             // Класс не задан =>
            $student->lectures = null;          // Лекций нет
        }
        unset($student->class_id, $student->id, $student->ClassForStudy);
        return $student;
    }

    public function createStudent(array $newStudent): Array {
        $student = new Student;
        $student->name = $newStudent['name'];
        $student->email = $newStudent['email'];
        if (array_key_exists("class_id", $newStudent)) {
            $student->class_id = $newStudent['class_id'];       //Если задан id класса у нового пользователя
        }
        $student->save();
        return [];
    }

    public function updateStudent(array $updateStudent): Array {
        $student = Student::findOrFail($updateStudent['id']);
        $student->class_id = $updateStudent['class_id'];
        $student->name = $updateStudent['name'];
        $student->Save();
        return [];
    }

    public function deleteStudent(array $id): Array {
        $student = Student::findOrFail($id['id']);
        $student->delete();
        return [];
    }

}
