<?php

namespace App\Http\Controllers\DataTables;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class SubCategoryDataTables extends Controller
{
    
 
    public function subcategory()
    {
        $data = SubCategory::select(
            'sub_categories.id',
            'sub_categories.name',
            'sub_categories.category_id',
        )
        // ->where('products.status', true)
        ->orderBy('sub_categories.id', 'DESC')
        ->get();
        return datatables()->collection($data)->toJson();
        // return Datatables::of($data)->make(true);
    }
    public function subcategorybycategory($id)
    {
        $data = SubCategory::select(
            'sub_categories.*',
        )
        ->where('sub_categories.category_id', $id)
        ->orderBy('sub_categories.id', 'DESC')
        ->get();
        return datatables()->collection($data)->toJson();
    }
}
