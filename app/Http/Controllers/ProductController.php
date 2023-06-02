<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Type;
use App\Models\Utility;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $empresa = "DIGITALTEI";
    public function index()
    {
        
        $product = Product::select(
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
        // dd($product);
        $titulo = "Gestion de Productos";
        $empresa = $this->nameEmpresa();
        return view('product.index', compact('product', 'empresa','titulo',));
    }
  
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $types = Type::all();
        $subcategories =  SubCategory::all();
        // $utilities = Utility::all();
        $titulo = "Editar producto";
        $empresa = $this->nameEmpresa();
        return view('product.edit',compact('product','brands','categories','types','subcategories','utilities','titulo','empresa'));
    }
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $types = Type::all();
        $subcategories =  SubCategory::all();
        // $utilities = Utility::all();
        $titulo = "Nuevo producto";
        $empresa = $this->nameEmpresa();
        return view('product.create',compact('brands','categories','types','subcategories','titulo','empresa'));
    }
    public function store(StoreProduct $request)
    {
        // $data = $request->all();
        // if ($request->hasFile('avatar')) {
        //     $avatar = $request->file('avatar');
        //     $filename = Str::random(20)  .'.' .$avatar->getClientOriginalExtension();
        //     $imgFile = Image::make($avatar->getRealPath());
        //     $ruta= storage_path().'\app\public\images/'.$filename;
        //     $imgFile->resize(400, 400, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })->save($ruta);
        //     $data['avatar'] = 'images/'.$filename;
        // } 
        // else {
        //     $data['avatar'] = 'images/default.png';
        // }
        // if (Product::create($data)) {
        //     return redirect()->route('product.index');
        // } else {
        //     unlink($ruta);
        //     return redirect()->back()->with('error', 'No se pudo registrar el registro.');
        // }
    }
    public function update(UpdateProduct $request, Product $product)
    {
        // $data = $request->all();
        // if ($request->hasFile('avatar')) {
        //     $avatar = $request->file('avatar');
        //     $filename = Str::random(20)  .'.' .$avatar->getClientOriginalExtension();
        //     $imgFile = Image::make($avatar->getRealPath());
        //     $ruta= storage_path().'\app\public\images/'.$filename;
        //     $imgFile->resize(400, 400, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })->save($ruta);
        //     $data['avatar'] = 'images/'.$filename;
        // } 
        // else {
        //     $data['avatar'] = $product->avatar;
        // }
        // if (!$request->hasFile('avatar')) {
        //     $data['file'] = $product->file;
        // }
        // if ($product->update($data)) {
        //     return redirect()->route('product.index');
        // } else {
        //     unlink($ruta);
        //     return redirect()->back()->with('error', 'No se pudo actualizar el registro.');
        // }
    }
    

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }
}
