<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'stock',
        'barcode',

    ];
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}
