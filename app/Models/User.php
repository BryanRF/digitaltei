<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\AuditLog;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
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
    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($user) {
    //         AuditLog::create([
    //             'model' => 'User',
    //             'model_id' => $user->id,
    //             'action' => 'create',
    //             'new_values' => $user->toJson(),
    //             'user_id' => auth()->id(),
    //         ]);
    //     });

    //     static::updating(function ($user) {
    //         AuditLog::create([
    //             'model' => 'User',
    //             'model_id' => $user->id,
    //             'action' => 'update',
    //             'old_values' => $user->getOriginal(),
    //             'new_values' => $user->toJson(),
    //             'user_id' => auth()->id(),
    //         ]);
    //     });

    //     static::deleting(function ($user) {
    //         AuditLog::create([
    //             'model' => 'User',
    //             'model_id' => $user->id,
    //             'action' => 'delete',
    //             'old_values' => $user->toJson(),
    //             'user_id' => auth()->id(),
    //         ]);
    //     });
    // }
}
