<?php

namespace App\Services\Gateways;

use App\Exceptions\Gateways\GatewayClientException;
use App\Exceptions\Gateways\GatewayException;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IdPayGatewayService implements GatewayInterfaceService
{
    /**
     * @throws GatewayException
     */
    public function requestPayment(Order $order): \Illuminate\Http\RedirectResponse
    {
        $headers = $this->makeRequestHeaders();
        $endPoint = $this->getEndpoint();
        $body = $this->makeRequestBody($order->id, $order->total_price);

        $response = Http::withHeaders($headers)->post($endPoint, $body);

        if ($response->clientError()) {
            throw new GatewayException("payment request has a problem");
        }
        if ($response->successful()) {
            return redirect()->route('payment.status')->with(['status' => 'successful']);
        } else {
            return redirect()->route('payment.status')->withErrors(['error' => 'payment failed']);
        }
    }

    public function handleCallback(Request $request)
    {
        if ($this->validatePayment($request)) {
            return response('successful');
        } else {
            throw new GatewayClientException('some problem has happened in validation');
        }
    }

    /**
     * Set request header for IDPAY IPG
     * @return array{X-API-KEY: mixed}
     */
    public function makeRequestHeaders(): array
    {
        return [
            'X-API-KEY' => config('payment.gateways.idpay.api_key'),
        ];
    }

    public function validatePayment(Request $request): bool
    {
        $order = Order::findById($request->orderId);

        if ($order->total_price == $request->cost) {
            $order->update([
                'status' => Order::PAID
            ]);
            return true;
        } else {
            return false;
        }
    }

    private function makeRequestBody(int $orderId, int $totalPrice): array
    {
        return [
            'order_id' => $orderId,
            'cost' => $totalPrice,
            'userName' => env('USERNAME') ?? null,
        ];
    }

    private function getEndpoint(): string
    {
        return "https://api.idpay.ir/v1.1/";
    }
}
