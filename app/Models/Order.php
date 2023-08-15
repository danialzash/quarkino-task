<?php

namespace App\Models;

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
}
