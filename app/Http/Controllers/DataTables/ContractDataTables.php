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
class ContractDataTables extends Controller
{
    
 
    public function contract(){
        $data = Contract::selectRaw('contracts.*,employees.*,CONCAT(UCASE(employees.name)," ",UCASE(employees.lastname)) as employee_name, jobs.name as job_name, CONCAT(TIMESTAMPDIFF(MONTH, start_date, end_date), " meses") as duration')
            ->join('jobs', 'jobs.id', '=', 'contracts.job_id')
            ->join('employees', 'employees.id', '=', 'contracts.employee_id')
            ->get()->map(function ($item) {
                $item->employee_name = ucwords(strtolower($item->employee_name));
                $item->start_date = \Carbon\Carbon::parse($item->start_date)->format('d/m/Y');
                $item->end_date = \Carbon\Carbon::parse($item->end_date)->format('d/m/Y');
                return $item;
            });
    
        return datatables()->of($data)->toJson();
    }
    public function contractTrashed(){
        $data = Contract::selectRaw('contracts.*,employees.*,CONCAT(UCASE(employees.name)," ",UCASE(employees.lastname)) as employee_name, jobs.name as job_name, CONCAT(TIMESTAMPDIFF(MONTH, start_date, end_date), " meses") as duration')
            ->join('jobs', 'jobs.id', '=', 'contracts.job_id')
            ->join('employees', 'employees.id', '=', 'contracts.employee_id')
            ->whereNotNull('contracts.deleted_at')->withTrashed() 
            ->get()->map(function ($item) {
                $item->employee_name = ucwords(strtolower($item->employee_name));
                $item->start_date = \Carbon\Carbon::parse($item->start_date)->format('d/m/Y');
                $item->end_date = \Carbon\Carbon::parse($item->end_date)->format('d/m/Y');
                return $item;
            });
    
        return datatables()->of($data)->toJson();
    }
    public function contractById($id){
         
        $data = Contract::selectRaw('contracts.*, jobs.name as job_name, CONCAT(TIMESTAMPDIFF(MONTH, start_date, end_date), " meses") as duration')
            ->join('jobs', 'jobs.id', '=', 'contracts.job_id')
            ->join('employees', 'employees.id', '=', 'contracts.employee_id')
            ->where('contracts.employee_id', $id)
            ->get()->map(function ($item) {
                $item->start_date = \Carbon\Carbon::parse($item->start_date)->format('d/m/Y');
                $item->end_date = \Carbon\Carbon::parse($item->end_date)->format('d/m/Y');
                return $item;
            });
        return datatables()->of($data)->toJson();
    }
    
}
