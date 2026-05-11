<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    protected $fillable = [
        'total_amount',
        'tax',
        'cashier',
    ];
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}
