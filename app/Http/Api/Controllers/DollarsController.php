<?php
namespace App\Http\Api\Controllers;

use App\Http\Api\Requests\DollarRequest;
use App\Services\DollarService;
use App\Traits\ResponseTrait;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;


class DollarsController extends Controller
{
    use ResponseTrait;
    protected DollarService $dollarService;

    public function __construct(DollarService $dollarService)
    {
        $this->dollarService = $dollarService;
    }

    public function index(DollarRequest $request): JsonResponse
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        try {
            $data = $this->dollarService->getDollars($startDate, $endDate);
            if ($data->isEmpty()) {
                return $this->respondWithMessage('No data found', 200, null);
            }
            return $this->respondWithMessage('Data is found', 200, $data);
        } catch (\RuntimeException $e) {
            return $this->respondWithError($e->getMessage(), 500);
        } catch (\Exception $e) {
            return $this->respondWithError('An unexpected error occurred', 500);
        }
    }
}

