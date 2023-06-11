<?php

namespace App\Http\Controllers\DataTables;

use App\Http\Controllers\Controller;
use App\Models\Product;
class ProductDataTables extends Controller
{
    public function product()
    {
        $data =   Product::with('brand','subCategory','images')->orderBy('products.id', 'DESC')->get();
        return datatables()->collection($data)->toJson();
    }
    public function productTrash()
    {
        $data =   Product::with('brand','subCategory','images')
        ->whereNotNull('products.deleted_at')->withTrashed()
        ->orderBy('products.id', 'DESC')
        ->get();
        return datatables()->collection($data)->toJson();
    }

    public function productLow()
    {
        $data =   Product::with('brand','subCategory','images')
        ->where('products.status', false)
        ->orderBy('products.id', 'DESC')
        ->get();
        return datatables()->collection($data)->toJson();
    }
}
