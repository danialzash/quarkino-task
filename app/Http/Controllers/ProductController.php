<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * This method return all products
     * @return Collection
     */
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Product::all();
    }
}
