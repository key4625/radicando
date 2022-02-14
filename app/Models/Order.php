<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function plants()
    {
        return $this->morphedByMany(Plant::class, 'orderable')->withPivot('quantity_kg', 'quantity_num','price_kg');
    }
    public function products()
    {
        return $this->morphedByMany(Product::class, 'orderable')->withPivot('quantity_kg', 'quantity_num','price_kg');
    }
}
