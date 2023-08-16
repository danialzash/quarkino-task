<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderServices\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    private OrderService $orderService;
    // todo: check this dependency
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @param StoreOrderRequest $request
     * @return JsonResponse
     */
    public function store(StoreOrderRequest $request) {
        try {
            return $this->orderService->createOrder($request);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 422);
        }
    }
}
