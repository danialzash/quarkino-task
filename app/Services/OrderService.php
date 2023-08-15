<?php

namespace App\Services;

use App\Exceptions\NotEnoughQuantityException;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Http\Requests\StoreOrderRequest;

class OrderService
{
    use OrderItemService;

    /**
     * @throws NotEnoughQuantityException
     *
     */
    public function createOrder(StoreOrderRequest $request): array
    {
        /** @var Order $order */

        $orderItems = $request->order_items;
        $this->validateItemsQuantity($orderItems);
        $order = $this->makeNewOrder($request->user->id);
        $this->createOrderItems($orderItems, $order);
        $totalPrice = $this->calculateOrderTotalPrice($order);
        $this->updateOrderStatus($order, $totalPrice);
        // use queue for update quantities
        $this->updateAvailableQuantity($orderItems);

        return ['orderId' => $order->id, 'totalPrice' => $totalPrice];
    }


    /**
     * @throws NotEnoughQuantityException
     */
    private function validateItemsQuantity(array $orderItems): void
    {
        // change it and make one query instead of this
        foreach ($orderItems as $productId => $orderQuantity) {

            $product = Product::where('id', $productId)->first();
            if ($orderQuantity > $product->available_quantity) {
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
            $productCost = Product::find($productId)->first()->cost;
            $newOrderItem = new OrderItem();
            $newOrderItem->order_id = $orderId;
            $newOrderItem->product_id = $productId;
            $newOrderItem->order_quantity = $orderQuantity;
            $newOrderItem->cost = $productCost * $orderQuantity;
            $newOrderItem->save();
        }
    }

    /**
     * @param Order $order
     * @return int
     */
    private function calculateOrderTotalPrice(Order $order): int
    {
        $itemCostsArray = $order->orderItems()
            ->pluck('cost')
            ->toArray();
        return array_sum($itemCostsArray);
    }

    /**
     * @param Order $order
     * @param int $totalPrice
     * @return void
     */
    private function updateOrderStatus(Order $order, int $totalPrice): void
    {
        $order->update(['total_price' => $totalPrice, 'status' => Order::CALCULATED]);
    }

    /**
     * @param array $orderItems
     * @return void
     */
    private function updateAvailableQuantity(array $orderItems): void
    {

        foreach ($orderItems as $productId => $orderQuantity) {
            $product = Product::find($productId);
            $previousQuantity = $product->available_quantity;
            $updatedQuantity = $previousQuantity - $orderQuantity;
            $product->update(['available_quantity' => $updatedQuantity]);
        }
    }
}
