<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassForStudyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LectureController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route::get('/',[StudentController::class, 'index']);

Route::group(['prefix' => 'students'], function(){
        Route::get('/',[StudentController::class, 'index']);
        Route::get('/{id}',[StudentController::class, 'getById']);
        Route::post('/create',[StudentController::class, 'createStudent']);
        Route::put('/update',[StudentController::class, 'updateStudent']);
        Route::delete('/delete',[StudentController::class, 'deleteStudent']);
});

Route::group(['prefix' => 'classes'], function(){
    Route::get('/',[ClassForStudyController::class, 'index']);
    Route::get('/{id}',[ClassForStudyController::class, 'getById']);
    Route::get('/{id}/getplan',[ClassForStudyController::class, 'getPlan']);
    Route::post('/setplan',[ClassForStudyController::class, 'setPlan']);
    Route::post('/create',[ClassForStudyController::class, 'createClass']);
    Route::put('/update',[ClassForStudyController::class, 'updateClass']);
    Route::delete('/delete',[ClassForStudyController::class, 'deleteClass']);
});

Route::group(['prefix' => 'lectures'], function(){
    Route::get('/',[LectureController::class, 'index']);
    Route::get('/{id}',[LectureController::class, 'getById']);
    Route::post('/create',[LectureController::class, 'createLecture']);
    Route::put('/update',[LectureController::class, 'updateLecture']);
    Route::delete('/delete',[LectureController::class, 'deleteLecture']);
});

Route::fallback(function (){
    abort(404, 'API resource not found');
});
