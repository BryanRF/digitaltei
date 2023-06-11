<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerType;
use Illuminate\Http\JsonResponse;
class CustomerTypeController extends Controller
{
    
//     public function index($customerId): JsonResponse
// {
//     $customerSales = Sale::where('customer_id', $customerId)->get();
//     return response()->json($customerSales);
// }
    public function index():JsonResponse
    {
        $data = CustomerType::all();
        return response()->json($data);
    }

    public function store(Request $request):int
    {
        return 0;
    }

    public function show($id):int
    {
        return 0;
    }

  
    public function update(Request $request, $id):int
    {
        return 0;
    }

   
    public function destroy($id):int
    {
        return 0;
    }
}
