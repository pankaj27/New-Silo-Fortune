<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TradingSeller extends Authenticatable
{
    use Notifiable;

    protected $casts = [
        'id' => 'integer',
        'orders_count' => 'integer',
        'product_count' => 'integer',
        'pos+status' => 'integer'
    ];

    public function scopeApproved($query)
    {
        return $query->where(['status'=>'approved']);
    }

    public function shop()
    {
        return $this->hasOne(TradingShop::class, 'seller_id');
    }

    public function shops()
    {
        return $this->hasMany(TradngShop::class, 'seller_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'seller_id');
    }

    public function product()
    {
        return $this->hasMany(TradingProduct::class, 'user_id')->where(['added_by'=>'seller']);
    }

    public function wallet()
    {
        return $this->hasOne(TradingSellerWallet::class, 'seller_id');
    }
    
}
