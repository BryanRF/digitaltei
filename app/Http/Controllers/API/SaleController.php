<?php

namespace App\Http\Controllers\API;
use App\Models\Sale;
use App\Models\SalesDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
class SaleController extends Controller
{

    public function index():JsonResponse
    {
        $data = Sale::with('payment_method','customer', 'details')->get();

        return response()->json([$data]);
    }
    public function store(Request $request):JsonResponse
    {
        DB::beginTransaction();
        try {
            // Crear la venta
            $sale = new Sale();
            $sale->customer_id = $request->customer_id;
            $sale->date = now();
            $sale->total_amount = $request->total_amount;
            $sale->payment_method_id = $request->payment_method_id;
            $sale->payment_status = $request->payment_status;
            $sale->status = $request->status;
            $sale->save();
            // Crear los detalles de la venta
            $details = $request->details;
            foreach ($details as $detailData) {
                $detail = new SalesDetail();
                $detail->sale_id = $sale->id;
                $detail->product_id = $detailData['product_id'];
                $detail->quantity = $detailData['quantity'];
                $detail->unit_price = $detailData['unit_price'];
                $detail->discount = $detailData['discount'];
                $detail->total = $detailData['total'];
                $detail->save();
            }
            DB::commit();
            return response()->json(['message' => 'Venta registrada exitosamente']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Error al registrar la venta: ' . $e->getMessage()], 500);
        }
    }
    public function show($id): JsonResponse
    {
        try {
            // Buscar la venta con sus detalles
            $sale = Sale::with('payment_method','customer', 'details')->findOrFail($id);
            return response()->json(['sale' => $sale]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al mostrar la venta: ' . $e->getMessage()], 500);
        }
    }
    public function update(Request $request, $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            // Actualizar la venta
            $sale = Sale::findOrFail($id);
            $sale->customer_id = $request->customer_id;
            $sale->employee_id = $request->employee_id;
            $sale->date = $request->date;
            $sale->status = $request->status;
            $sale->total_amount = $request->total_amount;
            $sale->payment_method_id = $request->payment_method_id;
            $sale->payment_status = $request->payment_status;
            $sale->save();
            $details = $request->details;
            SalesDetail::where('sale_id', $sale->id)->delete();
            foreach ($details as $detailData) {
                $detail = new SalesDetail();
                $detail->sale_id = $sale->id;
                $detail->product_id = $detailData['product_id'];
                $detail->quantity = $detailData['quantity'];
                $detail->unit_price = $detailData['unit_price'];
                $detail->discount = $detailData['discount'];
                $detail->total = $detailData['total'];
                $detail->save();
            }
            DB::commit();
            return response()->json(['message' => 'Venta actualizada exitosamente']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Error al actualizar la venta: ' . $e->getMessage()], 500);
        }
    }
    public function destroy($id): JsonResponse
{
    DB::beginTransaction();
    try {
        // Buscar la venta y eliminarla
        $sale = Sale::findOrFail($id);
        $sale->delete();
        // Eliminar los detalles asociados a la venta
        $sale->details()->delete();
        DB::commit();
        return response()->json(['message' => 'Venta eliminada exitosamente']);
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['message' => 'Error al eliminar la venta: ' . $e->getMessage()], 500);
    }
}
}
