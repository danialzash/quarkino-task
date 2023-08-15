<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // maximum number of products which user can see
    public const MAX_NUMBER_PER_PAGE = 10;
}
