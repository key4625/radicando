<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Order extends Model
{
    use HasFactory;
    use UsesTenantConnection;
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
