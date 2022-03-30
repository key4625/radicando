<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;

class Plant extends Model
{
    use HasFactory;
    use UsesLandlordConnection;
    protected $guarded = [];

    public function orders()
    {
        return $this->morphToMany(Order::class, 'orderable');
    }
    public function cultivations()
    {
        return $this->hasMany(Cultivation::class);
    }
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
    public function raccolti_oggi_kg()
    {
        return Collection::where('plant_id',$this->id)->whereDay('created_at', '=', date('d'))->sum('quantity_kg');
    }
    public function raccolti_oggi_nr()
    {
        return Collection::where('plant_id',$this->id)->whereDay('created_at', '=', date('d'))->sum('quantity_num');
    }
    public function raccolti_tot_kg()
    {
        return Collection::where('plant_id',$this->id)->sum('quantity_kg');
    }
    public function raccolti_tot_nr()
    {
        return Collection::where('plant_id',$this->id)->sum('quantity_num');
    }
}
