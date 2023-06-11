<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class ProductController extends Controller
{
    public function index():JsonResponse
    {
        $data = Product::with('brand','subCategory','images')->orderBy('products.id', 'DESC')->get();
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
    }
    public function showbycategory($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->pluck('id');
        $data = Product::with('brand','subCategory','images')
        ->whereIn('products.subcategory_id', $subcategories)
        ->orderBy('products.id', 'DESC')
        ->get();
        return response()->json($data);
    }
    public function showbysubcategory($id)
    {
        $data = Product::with('brand','subCategory','images')
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
