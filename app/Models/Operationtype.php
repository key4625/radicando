<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Operationtype extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function operations()
    {
        return $this->hasMany(Operations::class);
    }
}
