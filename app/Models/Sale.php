<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SalesDetail;
use App\Models\Customer;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Sale extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded =[];
    protected $table = 'sales';
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }
    public function details()
    {
        return $this->hasMany(SalesDetail::class, 'sale_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'sales_details');
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($sale) {
            $code = 'PD' . Sale::count() .'TRY'. date('dmy');
            $sale->code = strtoupper($code);
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
