<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Operation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function operationtype()
    {
        return $this->belongsTo(Operationtype::class);
    }
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
    public function cultivation()
    {
        return $this->belongsTo(Cultivation::class);
    }
    
}
