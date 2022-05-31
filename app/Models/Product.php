<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Product extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $guarded = [];

    public function orders()
    {
        return $this->morphToMany(Order::class, 'orderable')->withPivot('quantity','quantity_um','price','price_um');;;
    }

    public function getPriceAttribute($value)
    {
        return str_replace('.', ',', $value);
    }
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace(',', '.', $value);
    }
    public function getDimensionAttribute($value)
    {
        return str_replace('.', ',', $value);
    }
    public function setDimensionAttribute($value)
    {
        $this->attributes['dimension'] = str_replace(',', '.', $value);
    }

}
