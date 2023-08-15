<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * This method returns maximum number of products per user request
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $page = $request->query('page', 1);
        $perPage = Product::MAX_NUMBER_PER_PAGE;
        $products = Product::paginate($perPage, ['*'], 'page', $page);
        return response()->json($products);
    }
}
