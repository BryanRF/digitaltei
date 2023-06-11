<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SalesDetail;
use App\Models\Sale;
use App\Models\CartDetail;
use App\Models\Cart;
use App\Models\Images;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded =[];

    protected function name(): Attribute
    {
        return new Attribute(
            get:fn($value) => ucwords($value),
            set:fn($value) => strtolower($value)
        );
    }
    protected function description(): Attribute
    {
        return new Attribute(
            get:fn($value) => ucfirst($value),
            set:fn($value) => strtolower($value)
        );
    }
    protected function presentation(): Attribute
    {
        return new Attribute(
            get:fn($value) => ucfirst($value),
            set:fn($value) => strtolower($value)
        );
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $code = 'PRO' . Product::count() .''. date('MY');

            $product->code = strtoupper($code);
        });
    }
    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'sales_details');
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_details');
    }
    public function salesDetails()
    {
        return $this->hasMany(SalesDetail::class);
    }

    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }
    public function images()
    {
        return $this->hasMany(Images::class, 'product_id');
    }



}
