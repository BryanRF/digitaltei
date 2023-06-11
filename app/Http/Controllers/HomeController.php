<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Models\Task;
class HomeController extends Controller
{
    public function __invoke()
    {
        $titulo = "Inicio";
        $empresa = "DIGITALTEI";
        $task = Task::orderBy('start_date', 'DESC')->get();
        $data['TotalCustomers']=$this->getTotalCustomers();
        $data['MonthlyEarnings']=$this->getMonthlyEarnings();
        $data['MonthlySales']=$this->getMonthlySales();
        $data['PendingOrders']=$this->getPendingOrders();
        return view('Home',compact('titulo','empresa','task','data'));
    }
    public function getTotalCustomers()
    {
        try {
            $totalCustomers = Customer::count();
            return $totalCustomers ;
        } catch (\Exception $e) {
            return 0;
        }
    }
    public function getMonthlyEarnings()
    {
        try {
            $monthlyEarnings = Sale::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('total_amount');
            return $monthlyEarnings;
        } catch (\Exception $e) {
            return 0;
        }
    }
    public function getMonthlySales()
    {
        try {
            $monthlySales = Sale::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();
            return $monthlySales;
        } catch (\Exception $e) {
            return 0;
        }
    }
    public function getPendingOrders()
    {
        try {
            $pendingOrders = Sale::where('status', 'pending')->count();
            return $pendingOrders;
        } catch (\Exception $e) {
            return 0;
        }
    }
}
