<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Employee;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Type;
use App\Models\Utility;
class DatatablesController extends Controller
{
    public function employee()
    {
        $data =  Employee::select('employees.*', 'jobs.name as job_name')
        ->join('jobs', 'jobs.id', '=', 'employees.jobs_id')->orderBy('id','desc')
        ->get();
        return datatables()->collection($data)->toJson();
        // return Datatables::of($data)->make(true);
    }
    public function product()
    {
        $data =   Product::select(
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
        return datatables()->collection($data)->toJson();
        // return Datatables::of($data)->make(true);
    }
}
