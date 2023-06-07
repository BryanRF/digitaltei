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
class EmployeeDataTables extends Controller
{
    
    public function employee()
    {
        $data = Employee::select('employees.*')
        ->selectRaw('CONCAT (TIMESTAMPDIFF(YEAR, employees.birthday_date, CURDATE()), " años") AS age')
        ->selectRaw('jobs.name as job_name')
        ->join('jobs', 'jobs.id', '=', 'employees.job_id')
        ->orderBy('id', 'desc')
        ->get()
        ->map(function ($item) {
            $item->birthday_date = \Carbon\Carbon::parse($item->birthday_date)->format('d/m/Y');
            return $item;
        });
        return datatables()->collection($data)->toJson();
       
    }
    public function employeeTrashed()
    {
        $data = Employee::select('employees.*')
        ->selectRaw('CONCAT (TIMESTAMPDIFF(YEAR, employees.birthday_date, CURDATE()), " años") AS age')
        ->selectRaw('jobs.name as job_name')
        ->join('jobs', 'jobs.id', '=', 'employees.job_id')
        ->orderBy('id', 'desc')
            ->whereNotNull('employees.deleted_at')->withTrashed() 
            ->get()
            ->map(function ($item) {
                $item->birthday_date = \Carbon\Carbon::parse($item->birthday_date)->format('d/m/Y');
                return $item;
            });
        return datatables()->of($data)->toJson();
    }


}
