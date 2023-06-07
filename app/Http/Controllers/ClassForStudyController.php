<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClassCreateRequest;
use App\Http\Requests\ClassUpdateRequest;
use App\Http\Requests\ClassSetPlanRequest;
use App\Http\Requests\ClassIdRequest;
use Illuminate\Http\JsonResponse;
use App\Services\ClassService;

class ClassForStudyController extends Controller
{
    public function __construct(private ClassService $classService)
    {
    }

    public function execute($func, $params): JsonResponse {
        try {
            $result  = $this->classService->$func($params);
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
        return $this->execute('getAllClasses', null);
    }

    public function getById(int $id): JsonResponse {
        return $this->execute('getClass', $id);
    }

    public function getPlan(int $id): JsonResponse {
        return $this->execute('getPlan', $id);
    }

    public function setPlan(ClassSetPlanRequest $request): JsonResponse {
        return $this->execute('setPlan', $request->validated());
    }

    public function createClass(ClassCreateRequest $request): JsonResponse {
        return $this->execute('createClass', $request->validated());
    }

    public function updateClass(ClassUpdateRequest $request): JsonResponse {
        return $this->execute('updateClass', $request->validated());
    }

    public function deleteClass(ClassIdRequest $request): JsonResponse {
        return $this->execute('deleteClass', $request->validated());
    }

}
