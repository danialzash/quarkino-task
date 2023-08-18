<?php

namespace App\Services\OrderServices;

use App\Exceptions\OrderExceptions\NotEnoughQuantityException;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderService
{
    use OrderItemService;

    /**
     * @throws NotEnoughQuantityException
     *
     */
    public function createOrder(StoreOrderRequest $request): \Illuminate\Http\JsonResponse
    {
        /** @var Order $order */

        $orderItems = $request->order_items;
        $this->validateItemsQuantity($orderItems);
        $order = $this->makeNewOrder($request->user->id);
        $this->createOrderItems($orderItems, $order);
        $totalPrice = $this->calculateOrderTotalPrice($order);
        $this->updateOrderStatus($order, $totalPrice);

        return response()->json([
            'order' => $order,
            'totalPrice' => $totalPrice,
            'paymentUrl' => route('payment.purchase', ['order' => $order->id]),
        ]);
    }


    /**
     * @throws NotEnoughQuantityException
     */
    private function validateItemsQuantity(array $orderItems): void
    {
        // change it and make one query instead of this
        foreach ($orderItems as $productId => $orderQuantity) {
            $product = Product::find($productId);
            if ($orderQuantity >= $availableQuantity = $product->getAvailableQuantity()) {
                throw new NotEnoughQuantityException("variables are more than you want in $product->name");
            }

        }
    }

    /**
     * @param int $userId
     * @return Order
     */
    private function makeNewOrder(int $userId): Order
    {
        return Order::create([
            'user_id' => $userId,
            'status' => Order::CREATED,
            'total_price' => 0,
        ]);
    }

    /**
     * @param array $orderItems
     * @param Order $order
     * @return void
     */
    private function createOrderItems(array $orderItems, Order $order): void
    {
        $orderId = $order->id;
        foreach ($orderItems as $productId => $orderQuantity) {
            $product = Product::find($productId);
            $newOrderItem = new OrderItem();
            $newOrderItem->order_id = $orderId;
            $newOrderItem->product_id = $productId;
            $newOrderItem->order_quantity = $orderQuantity;
            $newOrderItem->cost = $product->getCost() * $orderQuantity;
            $newOrderItem->save();

            $product->decreaseQuantity($orderQuantity);
        }
    }

    /**
     * @param Order $order
     * @return int
     */
    private function calculateOrderTotalPrice(Order $order): int
    {
        return $order->orderItems()->sum('cost');
    }

    /**
     * @param Order $order
     * @param int $totalPrice
     * @return void
     */
    private function updateOrderStatus(Order $order, int $totalPrice): void
    {
        $order->setTotalPrice($totalPrice)
            ->setStatus(Order::CALCULATED);
    }

}
