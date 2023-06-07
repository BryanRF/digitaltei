<?php

namespace App\Http\Controllers\DataTables;

use App\Http\Controllers\Controller;
use App\Models\Product;
class ProductDataTables extends Controller
{
    public function product()
    {
        $data =   Product::select(
            'products.*',
            'brands.name as brand_name',
            'sub_categories.name as subcategory_name',
            'types.name as type_name'
        )
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
        ->join('types', 'products.type_id', '=', 'types.id')
        ->orderBy('products.id', 'DESC')
        ->get();
        return datatables()->collection($data)->toJson();
    }
    public function productTrash()
    {
        $data =   Product::select(
            'products.*',
            'brands.name as brand_name',
            'sub_categories.name as subcategory_name',
            'types.name as type_name'
        )
        ->whereNotNull('products.deleted_at')->withTrashed() 
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
        ->join('types', 'products.type_id', '=', 'types.id')
        ->orderBy('products.id', 'DESC')
        ->get();
        return datatables()->collection($data)->toJson();
    }
  
    public function productLow()
    {
        $data =   Product::select(
            'products.*',
            'brands.name as brand_name',
            'sub_categories.name as subcategory_name',
            'types.name as type_name'
        )
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
        ->join('types', 'products.type_id', '=', 'types.id')
        ->where('products.status', false)
        ->orderBy('products.id', 'DESC')
        ->get();
        return datatables()->collection($data)->toJson();
    }
}
