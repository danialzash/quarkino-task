<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * @return array|JsonResponse
     */
    public function store(StoreOrderRequest $request) {
        try {
            return $this->orderService->createOrder($request);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 422);
        }
    }

    public function payment(Request $request) {
        
    }
}
