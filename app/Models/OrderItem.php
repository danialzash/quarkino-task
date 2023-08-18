<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_quantity',
        'order_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getQuantity(): int
    {
        return $this->order_quantity;
    }

    public function setOrderItemQuantity(int $quantity): self
    {
        $this->update([
            'order_quantity' => $quantity,
        ]);

        return $this;
    }

    public function setCost(int $cost): self
    {
        $this->update([
            'cost' => $cost
        ]);

        return $this;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function setOrderId(int $orderId): self
    {
        $this->update([
            'order_id' => $orderId,
        ]);

        return $this;
    }

    public function setProductId(int $productId): self
    {
        $this->update([
            'order_id' => $productId,
        ]);

        return $this;
    }

}
