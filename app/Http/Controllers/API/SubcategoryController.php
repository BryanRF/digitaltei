<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $subcategories = SubCategory::all();
        $data = [];
        foreach ($subcategories as $subcategory) {
            // $products = Product::where('subcategory_id', $subcategory->id)->get();
            $products = Product::select(
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
            ->where('subcategory_id', $subcategory->id)
            ->orderBy('products.id', 'DESC')
            ->get();
            $data[] = [
                'subcategory' => $subcategory,
                'products' => $products,
            ];
        }
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
        //
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
