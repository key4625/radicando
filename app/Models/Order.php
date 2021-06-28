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
        return $this->belongsToMany(Plant::class)->withPivot('quantity_kg', 'quantity_num');
    }
}
