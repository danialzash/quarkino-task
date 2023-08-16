<?php

namespace App\Services;

use App\Models\OrderItem;

trait OrderItemService
{

    private function createOrderItem($orderId, $productId, $orderQuantity): int
    {
        $orderItem = OrderItem::create([
            'order_id' => $orderId,
            'product_id' => $productId,
            'order_quantity' => $orderQuantity,
        ]);

        return $orderItem->id;
    }

    /**
     * @param OrderItem $orderItem
     * @return int
     */
    private function calculateItemCost(OrderItem $orderItem): int
    {
        return $orderItem->order_quantity * $orderItem->product()->cost;
    }
}
