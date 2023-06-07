<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClassForStudy;
use App\Models\Student;
use App\Models\Lecture;
use App\Services\ClassService;


class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
            ClassForStudy::factory()->count(20)->create();          //Формируем тестовые данные
            Student::factory()->count(500)->create();
            Lecture::factory()->count(100)->create();

                                //Учебные планы
            $cs = new ClassService;                     //Однократный вызов сервиса класса для генерации учебных планов
            $classes = ClassForStudy::all();            //Берём все классы
            foreach($classes as $cl) {                  //Проходим...

                $random_number_array = range(1, 100);
                shuffle($random_number_array);
                $random_number_array = array_slice($random_number_array, 0 ,10);         //Тасуем 100 лекций и обрезаем до 10 значений
                $plan = (['id' => $cl->id, 'lectures' => $random_number_array]);
                $cs->setPlan($plan);
            }

    }
}
