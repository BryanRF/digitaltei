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
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    protected $empresa = "DIGITALTEI";
    public function index()
    {
        $titulo = "Gestion de Productos";
        $empresa = $this->nameEmpresa();
        return view('product.index', compact('empresa','titulo',));
    }
  
    public function edit(Product $product)
    {
        $product= Product::select(
            'products.*',
            'brands.name as brand_name',
            'sub_categories.name as subcategory_name',
            'types.name as type_name',
            'sub_categories.category_id as categories_id'
        )
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
        ->join('types', 'products.type_id', '=', 'types.id')
        ->where('products.id',$product->id)
        ->orderBy('products.id', 'DESC')
        ->first();
        $brands = Brand::all();
        $categories = Category::all();
        $types = Type::all();
        $subcategories =  SubCategory::all();
        $titulo = "Editar producto";
        $empresa = $this->nameEmpresa();
        return view('product.edit',compact('product','brands','categories','types','subcategories','titulo','empresa'));
    }
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $types = Type::all();
        $subcategories =  SubCategory::all();
        $titulo = "Nuevo producto";
        $empresa = $this->nameEmpresa();
        return view('product.create',compact('brands','categories','types','subcategories','titulo','empresa'));
    }
    public function store(StoreProduct $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
    
            $imgFile = Image::make($image->getRealPath());
            $ruta = 'public/images/' . $filename;
    
            $imgFile->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/' . $ruta));
    
            $data['image'] = $ruta;
        } 

        if (Product::create($data)) {
            $success="Producto registrado.";
            return redirect()->route('product.index')->with('success', $success);
        } else {
            if (isset($ruta)) {
                unlink($ruta);
            }
            return redirect()->back()->with('error', 'No se pudo registrar el registro.');
        }
    }
    public function update(UpdateProduct $request, Product $product)
    {
        $data = $request->all();
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
    
            $imgFile = Image::make($image->getRealPath());
            $ruta = 'public/images/' . $filename;
    
            $imgFile->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/' . $ruta));
    
            // Elimina el "/public" de la ruta para que coincida con la ruta deseada
            $data['image'] = Str::replaceFirst('public/', '', $ruta);
        } else {
            $data['image'] = $product->image;
        }
        
        if ($product->update($data)) {
            $success="Empleado actualizado.";
            return redirect()->route('product.index')->with('success', $success);
        } else {
            unlink($ruta);
            return redirect()->back()->with('error', 'No se pudo actualizar el registro.');
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $name = $product->name;
        $product->delete();
        return response()->json(['message' => $name]);

    }
}
