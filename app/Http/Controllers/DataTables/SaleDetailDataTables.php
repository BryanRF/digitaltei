<?php

namespace App\Http\Controllers\DataTables;

use App\Http\Controllers\Controller;
use App\Models\SalesDetail;

class SaleDetailDataTables extends Controller
{
    public function salesDetails($id)
    {
        $data = SalesDetail::with(['product'])->where('sale_id', $id)->get();
        return datatables()->collection($data)->toJson();
    }

}
