<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class cultivation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function plants()
    {
        return $this->hasMany(Plant::class);
    }
}
