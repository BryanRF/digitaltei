<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded =[];
    // public function getRouteKeyName()
    // {
    //     // return $this->getKeyName();
    //     return 'slug'; 

    // }
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
            $product->code = strtoupper(uniqid(7).date('Y'));
        });
    }

    
    
}
