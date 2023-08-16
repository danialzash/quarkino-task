<?php

namespace App\Services\Gateways;

use App\Models\Order;
use Illuminate\Http\Request;

class ZarinpalGatewayService implements GatewayInterfaceService
{
    public function handleCallback(Request $request)
    {
        // TODO: Implement handleCallback() method.
    }

    public function requestPayment(Order $order)
    {
        //
    }

    public function validatePayment(Request $request)
    {
        //
    }

}
