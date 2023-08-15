<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
