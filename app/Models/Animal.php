<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Animal extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $guarded = [];

    public function orders()
    {
        return $this->morphToMany(Order::class, 'orderable');
    }
    public function cultivations()
    {
        return $this->morphMany(Cultivation::class, 'cultivable');
    }
    public function collections()
    {
        return $this->morphMany(Collection::class, 'collectionable');
    }
    public function raccolti_oggi_kg()
    {
        return Collection::where('collectionable_id',$this->id)->where('collectionable_type','App\Models\Animal')->whereDay('created_at', '=', date('d'))->sum('quantity_kg');
    }
    public function raccolti_oggi_nr()
    {
        return Collection::where('collectionable_id',$this->id)->where('collectionable_type','App\Models\Animal')->whereDay('created_at', '=', date('d'))->sum('quantity_num');
    }
    public function raccolti_tot_kg()
    {
        return Collection::where('collectionable_id',$this->id)->where('collectionable_type','App\Models\Animal')->sum('quantity_kg');
    }
    public function raccolti_tot_nr()
    {
        return Collection::where('collectionable_id',$this->id)->where('collectionable_type','App\Models\Animal')->sum('quantity_num');
    }
}
