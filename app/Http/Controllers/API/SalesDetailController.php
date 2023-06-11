<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SalesDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
{
    try {
        // Obtener los productos más vendidos por mes
        $productsByMonth = SalesDetail::with('product')
            ->select('product_id', DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id', 'month', 'year')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->take(10)
            ->get();
            foreach ($productsByMonth as $salesDetail) {
                $product = $salesDetail->product;
                // Accede a los datos del producto, como $product->name, $product->price, etc.
            }
        // Obtener el top de productos anuales
        $productsByYear = SalesDetail::select('product_id', DB::raw('YEAR(created_at) as year'), DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id', 'year')
            ->orderBy('year', 'desc')
            ->take(10)
            ->get();
            foreach ($productsByYear as $salesDetail) {
                $product = $salesDetail->product;
                // Accede a los datos del producto, como $product->name, $product->price, etc.
            }

        // Obtener el top de productos de la semana actual
        $currentWeek = date('W');
        $productsByWeek = SalesDetail::select('product_id', DB::raw('YEAR(created_at) as year'), DB::raw('WEEK(created_at) as week'), DB::raw('SUM(quantity) as total_quantity'))
            ->where(DB::raw('YEAR(created_at)'), '=', date('Y'))
            ->where(DB::raw('WEEK(created_at)'), '=', $currentWeek)
            ->groupBy('product_id', 'year', 'week')
            ->orderBy('total_quantity', 'desc')
            ->take(10)
            ->get();
             foreach ($productsByWeek as $salesDetail) {
                $product = $salesDetail->product;
                // Accede a los datos del producto, como $product->name, $product->price, etc.
            }

        return response()->json([
            'products_by_month' => $productsByMonth,
            'products_by_year' => $productsByYear,
            'products_by_week' => $productsByWeek,
        ]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error retrieving sales details: ' . $e->getMessage()], 500);
    }
}

    public function show($id): JsonResponse
    {
        try {
            $salesDetail = SalesDetail::findOrFail($id);

            return response()->json(['sales_detail' => $salesDetail]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error retrieving sales detail: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $data = $request;

            $salesDetail = SalesDetail::create($data);

            // Actualizar total_amount en la tabla sales
            $sale = $salesDetail->sale;
            $sale->total_amount += $salesDetail->total;
            $sale->save();

            return response()->json(['message' => 'Sales detail created successfully', 'sales_detail' => $salesDetail]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating sales detail: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $data = $request;

            $salesDetail = SalesDetail::findOrFail($id);
            $salesDetail->update($data);

            // Actualizar total_amount en la tabla sales
            $sale = $salesDetail->sale;
            $previousTotal = $salesDetail->total;
            $sale->total_amount -= $previousTotal;
            $sale->total_amount += $salesDetail->total;
            $sale->save();

            return response()->json(['message' => 'Sales detail updated successfully', 'sales_detail' => $salesDetail]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating sales detail: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        try {
            $salesDetail = SalesDetail::findOrFail($id);
            $salesDetail->delete();

            // Actualizar total_amount en la tabla sales
            $sale = $salesDetail->sale;
            $sale->total_amount -= $salesDetail->total;
            $sale->save();

            return response()->json(['message' => 'Sales detail deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting sales detail: ' . $e->getMessage()], 500);
        }
    }
}
