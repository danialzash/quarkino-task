<?php

namespace App\Services\Gateways;

use App\Exceptions\GatewayExceptions\GatewayClientException;
use App\Exceptions\GatewayExceptions\GatewayException;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        return redirect()->route('payment.success');
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     * @throws GatewayClientException
     */
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
            // other headers should be set for IDpayGatewayService
        ];
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function validatePayment(Request $request): bool
    {
        $order = Order::find($request->order_id);

        if ($this->isPaymentValid($order, $request->cost)) {
            $this->markOrderAsPaid($order);
            return true;
        }

        return false;
    }

    /**
     * @param Order $order
     * @param $cost
     * @return bool
     */
    private function isPaymentValid(Order $order, $cost): bool
    {
        return $order->total_price == $cost;
    }

    /**
     * @param Order $order
     * @return void
     */
    private function markOrderAsPaid(Order $order): void
    {
        $order->update([
            'status' => Order::PAID
        ]);
    }

    /**
     * @param int $orderId
     * @param int $totalPrice
     * @return array
     */
    private function makeRequestBody(int $orderId, int $totalPrice): array
    {
        return [
            'order_id' => $orderId,
            'cost' => $totalPrice,
            'userName' => env('USERNAME') ?? null,
            // other options should be added here
        ];
    }

    /**
     * @return string
     */
    private function getEndpoint(): string
    {
        return config('payment.gateways.idpay.endpoint');
    }
}
