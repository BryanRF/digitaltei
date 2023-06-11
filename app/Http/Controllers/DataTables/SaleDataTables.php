<?php

namespace App\Http\Controllers\DataTables;

use App\Http\Controllers\Controller;
use App\Models\Sale;

class SaleDataTables extends Controller
{
    public function sale()
    {
        $data = Sale::with(['customer', 'payment_method'])->get();
        return datatables()->collection($data)->toJson();
    }
    public function saleTrash()
    {
        $data = Sale::with(['customer', 'payment_method'])->whereNotNull('sales.deleted_at')->withTrashed()->get();
        return datatables()->collection($data)->toJson();
    }
}
