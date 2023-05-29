<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Type;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.price',
            'products.presentation',
            'products.status',
            'products.slug',
            'products.image',
            // 'products.utility',
            'brands.name as brand_name',
            'sub_categories.name as subcategory_name',
            'types.name as type_name'
        )
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
        ->join('types', 'products.type_id', '=', 'types.id')
        // ->where('products.status', true)
        ->orderBy('products.id', 'DESC')
        ->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function showbycategory($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->pluck('id');
        $data = Product::select(
            'products.id',
            'products.name',
            'products.description',
            'products.price',
            'products.presentation',
            'products.status',
            'products.slug',
            'products.image',
            'brands.name as brand_name',
            'sub_categories.name as subcategory_name',
            'types.name as type_name'
        )
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
        ->join('types', 'products.type_id', '=', 'types.id')
        ->whereIn('products.subcategory_id', $subcategories)
        ->orderBy('products.id', 'DESC')
        ->get();
        return response()->json($data);
    }

    public function showbysubcategory($id)
    {
         $data = Product::select(
        'products.id',
        'products.name',
        'products.description',
        'products.price',
        'products.presentation',
        'products.status',
        'products.slug',
        'products.image',
        'brands.name as brand_name',
        'sub_categories.name as subcategory_name',
        'types.name as type_name'
    )
    ->join('brands', 'products.brand_id', '=', 'brands.id')
    ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
    ->join('types', 'products.type_id', '=', 'types.id')
    ->where('products.subcategory_id', $id)
    ->orderBy('products.id', 'DESC')
    ->get();
    return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
