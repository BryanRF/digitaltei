<?php

namespace App\Http\Controllers\DataTables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Employee;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contract;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Type;
use App\Models\Utility;
use Illuminate\Database\Eloquent\SoftDeletes;
class CategoryDataTables extends Controller
{
    
   


    public function category()
    {
        $data = Category::select(
            'categories.id',
            'categories.name',
            'categories.image'
        )
  
        ->orderBy('categories.id', 'DESC')
        ->get();
        return datatables()->collection($data)->toJson();
    }
    public function categorybysubcategory($id)
    {
        $datex= SubCategory::find($id);
        $data = Category::select(
            'categories.*',
        )
        ->where('categories.id', $datex->category_id)
        ->orderBy('categories.id', 'DESC')

        ->get();
        return datatables()->collection($data)->toJson();
    }
 
}
