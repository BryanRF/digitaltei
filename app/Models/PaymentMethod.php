<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
