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
    public function parent()
	{
    	return $this->hasOne(Field::class, 'id', 'parent_id');
	}

	public function children()
	{
	   	return $this->hasMany(Field::class, 'parent_id', 'id');
	}

    public function actual_cultivation() 
    {
        $cult = Cultivation::where('field_id',$this->id)->get()->first();
        return $cult ;
    }
}
