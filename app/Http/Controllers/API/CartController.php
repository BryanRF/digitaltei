<?php

namespace App\Http\Controllers\API;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():JsonResponse
    {
        $data = Cart::with('customer', 'details')->get();
        return response()->json([$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request):JsonResponse
    {
        DB::beginTransaction();

        try {
            // Crear la venta
            $Cart = new Cart();
            $Cart->customer_id = $request->customer_id;
            // $Cart->employee_id = $request->employee_id;
            $Cart->date = $request->date;
            // $Cart->code = $request->code;
            $Cart->total_amount = $request->total_amount;
            $Cart->payment_method = $request->payment_method;
            $Cart->payment_status = $request->payment_status;
            $Cart->save();
            // Crear los detalles de la venta
            $details = $request->details;
            foreach ($details as $detailData) {
                $detail = new CartDetail();
                $detail->Cart_id = $Cart->id;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        try {
            // Buscar la venta con sus detalles
            $Cart = Cart::with('details')->findOrFail($id);
    
            return response()->json(['Cart' => $Cart]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al mostrar la venta: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            // Actualizar la venta
            $Cart = Cart::findOrFail($id);
            $Cart->customer_id = $request->input('customer_id');
            $Cart->employee_id = $request->input('employee_id');
            $Cart->date = $request->input('date');
            $Cart->code = $request->input('code');
            $Cart->total_amount = $request->input('total_amount');
            $Cart->payment_method = $request->input('payment_method');
            $Cart->payment_status = $request->input('payment_status');
            $Cart->save();
            // Actualizar los detalles de la venta
            $details = $request->input('details');
            // Eliminar detalles existentes
            CartDetail::where('Cart_id', $Cart->id)->delete();
            // Crear los nuevos detalles
            foreach ($details as $detailData) {
                $detail = new CartDetail();
                $detail->Cart_id = $Cart->id;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
{
    DB::beginTransaction();

    try {
        // Buscar la venta y eliminarla
        $Cart = Cart::findOrFail($id);
        $Cart->delete();
        // Eliminar los detalles asociados a la venta
        $Cart->details()->delete();
        DB::commit();
        return response()->json(['message' => 'Venta eliminada exitosamente']);
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['message' => 'Error al eliminar la venta: ' . $e->getMessage()], 500);
    }
}
}
