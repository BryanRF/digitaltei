<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
class Contract extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded =[];
    protected function description(): Attribute
    {
        return new Attribute(
            get:fn($value) => ucwords($value),
            set:fn($value) => strtolower($value)
        );
    }
    
    
    
}