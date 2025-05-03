<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role; 
use App\Models\Admin\Order; 
use App\Models\Admin\PinOffice; 
use App\Models\Front\Adress;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Notifications\AdminResetPasswordNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'city',
        'otp',
        'otp_expiry',
        'otp_verified',
        'otp_verified_at',
        'google_id',
        'facebook_id',
        'pincode_id',
        'pin_code',
        'state',
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
        'otp_verified_at' => 'datetime', // Make sure to cast otp_verified_at if needed
    ];

    /**
     * Scope a query to only include users with a given role.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRole($query, $role)
    {
        return $query->whereHas('roles', function ($q) use ($role) {
            $q->where('name', $role);
        });
    }

     // Relationship with orders
     public function orders()
     {
         return $this->hasMany(Order::class, 'customer_id'); 
     }
 
     // Relationship with addresses
     public function addresses()
     {
         return $this->hasMany(Adress::class, 'customer_id'); 
     }

     public function pincode()
     {
         return $this->belongsTo(PinOffice::class,'pincode_id');
     }
    /**
     * Get the roles for the user.
     */
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
}

