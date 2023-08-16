<?php

namespace App\Services\Gateways;

use App\Models\Order;
use Illuminate\Http\Request;

interface GatewayInterfaceService
{
    public function requestPayment(Order $order);
    public function handleCallback(Request $request);
    public function validatePayment(Request $request);

}
