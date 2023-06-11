<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Images;


class ImageController extends Controller
{
    public function create($product_id)
    {
        $producto= Product::where('id',$product_id)->first();
        $titulo = "Imagenes de ".$producto->name;
        $empresa = $this->nameEmpresa();
        $images= Images::where('product_id',$product_id)->get();
        return view('image.create',compact('titulo','product_id','empresa','images'));
    }
    public function store(Request $request,$product_id){
        $request->validate(['file'=>'required|image']);

            $image = $request->file('file');
            $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();

            $imgFile = Image::make($image->getRealPath());
            $ruta = 'public/images/' . $filename;

            $imgFile->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/' . $ruta));

            $data['name'] = Str::replaceFirst('public/', '', $ruta);
            $data['product_id'] = $product_id;
            Images::create($data);
    }
    public function destroy($id)
    {
        try {
            $image = Images::findOrFail($id);
            $image->delete();

            return response()->json(['message' => 'Eliminado correctamente'],200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar la imagen'], 500);
        }
    }

}
