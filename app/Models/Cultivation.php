<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cultivation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
