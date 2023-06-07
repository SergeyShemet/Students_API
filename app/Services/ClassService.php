<?php
declare(strict_types=1);
namespace App\Services;

use App\Models\ClassForStudy;
use App\Models\LearningProgram;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClassService {

    public function getAllClasses(): Collection {
        $classes = ClassForStudy::select('id', 'name')->orderBy('id')->get();
        return $classes->pluck('name','id');
    }

    public function getClass(int $id): ClassForStudy {
        $class = ClassForStudy::with('students')->find($id);
        if (!isset($class)) {
            throw new ModelNotFoundException("ID не найден в базе данных.");
        }
        $students = $class->Students()->pluck('name','id'); //Получаем список студентов класса, выбираем нужные столбцы
        unset($class->id, $class->students);                //Удаляем список с лишней информацией
        $class->students = $students;                       //Крепим список с актуальным
        return $class;
    }

    public function getPlan(int $id):  Collection {
        $class = ClassForStudy::with('lectures')->find($id);
        if (!isset($class)) {
            throw new ModelNotFoundException("ID не найден в базе данных.");
        }
        $class = $class->Lectures()->pluck('subject','id');
        unset($class->id, $class->lectures);
        $class->class = $class;
        return $class;
    }

    public function setPlan(array $obj): Array {
        LearningProgram::where('class_id', $obj['id'])->delete(); //Чистим старую программу обучения класса

        foreach($obj['lectures'] as $lect) {
            $lp = new LearningProgram;
            $lp->class_id = $obj['id'];                 //Формируем новый учебный план для класса
            $lp->lecture_id = $lect;
            $lp->save();
        }
        return [];
    }

    public function createClass(array $newClass): Array {
        $class = new ClassForStudy;
        $class->name = $newClass['name'];
        $class->save();
        return [];
    }

    public function updateClass(array $updateClass): Array {
        $class = ClassForStudy::findOrFail($updateClass['id']);
        $class->name = $updateClass['name'];
        $class->Save();
        return [];
    }

    public function deleteClass(array $id): Array {
        $class = ClassForStudy::with('students')->findOrFail($id['id']);
        $class->Students()->update(['class_id' => Null]);   // Очищаем принадлежность к классу
        $class->delete();      //Лекция удаляется из учебного плана автоматически (каскадно)
        return [];
    }
}
