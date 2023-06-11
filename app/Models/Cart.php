<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CartDetail;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded =[];
    protected $table = 'sales';

    public function details()
    {
        return $this->hasMany(CartDetail::class, 'cart_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_details');
    }

    protected static function boot()
    {
        parent::boot();
        // self::saving(function ($sale) {
        //     $total = $sale->saleDetails()->sum('total');
        //     $sale->total_amount = $total;
        // });
        static::creating(function ($sale) {
            $prefix = 'SALE';
            $codeLength = 30; // Longitud del código, puedes ajustarla según tus necesidades
            
            $uniqueId = strtoupper(uniqid().date('Y'));
            $code = strtoupper(substr($uniqueId, 0, $codeLength));

            $sale->code = $prefix . $sale->id . $code;
        });
    }
    protected function name(): Attribute
    {
        return new Attribute(
            get:fn($value) => ucwords($value),
            set:fn($value) => strtolower($value)
        );
    }
 
    protected function lastname(): Attribute
    {
        return new Attribute(
            get:fn($value) => ucwords($value),
            set:fn($value) => strtolower($value)
        );
    }
}
