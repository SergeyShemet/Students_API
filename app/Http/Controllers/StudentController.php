<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Requests\StudentIdRequest;
use Illuminate\Http\JsonResponse;
use App\Services\StudentService;

class StudentController extends Controller
{

    public function __construct(private StudentService $studentService)
    {
    }

    public function execute($func, $params): JsonResponse {
        try {
            $result  = $this->studentService->$func($params);
        } catch (\Exception $e) {
            return response()->json([
                'data' => [],
                'message' => 'Ошибка. Не найден ID.'//$e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->json([
            'data' => $result,
            'message' => 'Success'
        ], JsonResponse::HTTP_OK);
    }

    public function index(): JsonResponse {
        return $this->execute('getAllStudents', null);
    }

    public function getById(int $id): JsonResponse {
        return $this->execute('getStudent', $id);
    }

    public function createStudent(StudentCreateRequest $request): JsonResponse {
        return $this->execute('createStudent', $request->validated());
    }

    public function updateStudent(StudentUpdateRequest $request): JsonResponse {
        return $this->execute('updateStudent', $request->validated());
    }

    public function deleteStudent(StudentIdRequest $request): JsonResponse {
        return $this->execute('deleteStudent', $request->validated());
    }

}
