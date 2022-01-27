<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'points' => 'array'
    ];

    public function cultivations()
    {
        return $this->hasMany(Cultivation::class);
    }

    public function setPointsAttribute($value)
    {
        $points = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item['key'])) {
                $points[] = $array_item;
            }
        }

        $this->attributes['points'] = json_encode($points);
    }

 
}
