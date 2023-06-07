<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\LectureCreateRequest;
use App\Http\Requests\LectureUpdateRequest;
use App\Http\Requests\LectureIdRequest;
use App\Services\LectureService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LectureController extends Controller
{

    public function __construct(private LectureService $lectureService)
    {
    }

    public function execute($func, $params): JsonResponse {
        try {
            $result  = $this->lectureService->$func($params);
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


    public function index(): JsonResponse
    {
        return $this->execute('getAllLectures', null);
    }

    public function getById(int $id): JsonResponse {
        return $this->execute('getLecture', $id);
    }

    public function createLecture(LectureCreateRequest $request): JsonResponse {
        return $this->execute('createLecture', $request->validated());
    }

    public function updateLecture(LectureUpdateRequest $request): JsonResponse {
        return $this->execute('updateLecture', $request->validated());
    }

    public function deleteLecture(LectureIdRequest $request): JsonResponse {
        return $this->execute('deleteLecture', $request->validated());
    }

}
