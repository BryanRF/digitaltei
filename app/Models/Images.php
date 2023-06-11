<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Images extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}
protected function name(): Attribute
    {
        return new Attribute(
            get:fn($value) => ucwords($value),
            set:fn($value) => strtolower($value)
        );
    }

}
