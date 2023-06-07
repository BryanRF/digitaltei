<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\AuditLog;
use Illuminate\Contracts\Auth\MustVerifyEmail;
class User extends Authenticatable implements MustVerifyEmail
{

    use HasApiTokens, HasFactory, Notifiable;


 
    protected $fillable = [
        'name',
        'email',
        'password',
        'employee_id',
        'customer_id'
    ];

   
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected function name(): Attribute
    {
        return new Attribute(
            get:fn($value) => ucwords($value),
            set:fn($value) => strtolower($value)
        );
    }
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->password =bcrypt($user->password);
        });
    }
 
}
