<?php
declare(strict_types=1);
namespace App\Services;

use App\Models\Lecture;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LectureService {

    public function getAllLectures(): Collection {
        $Lectures = Lecture::orderBy('id')->get();
        return $Lectures->pluck('subject','id');
    }

    public function getLecture(int $id): Lecture {
        $lecture = Lecture::with('classforstudy.students')->find($id);
        if (!isset($lecture)) {
            throw new ModelNotFoundException("ID не найден в базе данных.");
        }
        $classes = $lecture->classforstudy;         //Берём все классы и студентов
        if (!is_null($classes)) {                   //Если есть - конвертируем и присоединяем
            $students = collect();
                foreach($classes as $class) {
                    $curstuds = $class->students->pluck('id','name');          //Вычленяем всех студентов из каждого
                    $students = $students->merge($curstuds);                  //       класса в отдельный массив
                }
                $lecture->classes = $classes->pluck('name','id');           //Крепим имена классов
                $lecture->students = $students;                             //Крепим имена студентов
        } else {
            $lecture->classes = null;
            $lecture->students = null;
        }
        unset($lecture->id, $lecture->classforstudy);               //Убираем ненужные данные
        return $lecture;
    }

    public function createLecture(array $newLecture):Array {
        $lecture = new Lecture;
        $lecture->subject = $newLecture['subject'];
        $lecture->description = $newLecture['description'];
        $lecture->save();
        return [];
    }

    public function updateLecture(array $updateLecture):Array {
        $lecture = Lecture::findOrFail($updateLecture['id']);
        $lecture->subject = $updateLecture['subject'];
        $lecture->description = $updateLecture['description'];
        $lecture->Save();
        return [];
    }

    public function deleteLecture(array $id):Array {
        $lecture = Lecture::findOrFail($id['id']);
        $lecture->delete();      //Лекция удаляется из учебных планов автоматически (каскадно)
        return [];
    }

}
