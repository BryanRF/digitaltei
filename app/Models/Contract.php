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
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($contract) {
            $prefix = 'CTRC';
            $codeLength = 11; // Longitud del código, puedes ajustarla según tus necesidades
            
            $uniqueId = strtoupper(uniqid().date('Y'));
            $code = strtoupper(substr($uniqueId, 0, $codeLength));
            
            $contract->code = $prefix . $contract->id . $code;
        });
    }
    
    
}
