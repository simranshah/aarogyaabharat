<?php

namespace App\Models\Admin;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer  extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $gaurd = 'customer';
    protected $table = 'customers';
    protected $fillable = [
        'full_name',
        'email',
        'mobile',
        'city',
        'otp',
        'otp_expiry',
        'otp_verified',
        'otp_verified_at',
    ];

    public function addresses()
    {
        return $this->hasMany(\App\Models\Front\Adress::class);
    }

    public function notifications()
    {
        return $this->morphMany('Illuminate\Notifications\DatabaseNotification', 'notifiable');
    }
}
