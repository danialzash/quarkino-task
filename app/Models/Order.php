<?php

namespace App\Models;

use App\Exceptions\OrderExceptions\InvalidOrderStatusException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public const CREATED = 'created';
    public const CALCULATED = 'calculated';
    public const PAID = 'paid';
    public const FINISHED = 'finished';
    public const STATUS = [
        Order::CREATED,
        Order::CALCULATED,
        Order::PAID,
        Order::FINISHED,
    ];

    protected $fillable = [
        'user_id',
        'status',
        'total_price',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @throws InvalidOrderStatusException
     */
    public function setStatus(string $status): self
    {
        if (!in_array($status, Order::STATUS)) {
            throw new InvalidOrderStatusException('Invalid status value');
        }
        $this->update([
            'status' => $status,
        ]);

        return $this;
    }

    public function getTotalPrice(): int
    {
        return $this->total_price;
    }

    public function setTotalPrice(int $totalPrice): self
    {
        $this->update([
            'total_price' => $totalPrice,
        ]);

        return $this;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

}
