<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Plant extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $guarded = [];

    public function orders()
    {
        return $this->morphToMany(Order::class, 'orderable');
    }
    public function plantcategory()
    {
        return $this->belongsTo(Plantcategory::class);
    }
    public function cultivations()
    {
        return $this->morphMany(Cultivation::class, 'cultivable');
    }
    public function collections()
    {
        return $this->morphMany(Collection::class, 'collectionable');
    }
    public function getImage()
    {
        if( $this->image !=null){
            return $this->image;
        } else {  
            return "/img/img-placeholder.png";
        }    
    }
    public function raccolti_oggi_kg()
    {
        return Collection::where('collectionable_id',$this->id)->where('collectionable_type','App\Models\Plant')->whereDay('created_at', '=', date('d'))->sum('quantity_kg');
    }
    public function raccolti_oggi_nr()
    {
        return Collection::where('collectionable_id',$this->id)->where('collectionable_type','App\Models\Plant')->whereDay('created_at', '=', date('d'))->sum('quantity_num');
    }
    public function raccolti_tot_kg()
    {
        return Collection::where('collectionable_id',$this->id)->where('collectionable_type','App\Models\Plant')->sum('quantity_kg');
    }
    public function raccolti_tot_nr()
    {
        return Collection::where('collectionable_id',$this->id)->where('collectionable_type','App\Models\Plant')->sum('quantity_num');
    }
    public static function piante_semina_mese($actual_month) 
    {
        return Plant::whereJsonContains('semina',$actual_month)->get();
    }
    public static function piante_semina_out_mese($actual_month) 
    {
        return Plant::whereJsonContains('semina_out',$actual_month)->get();
    }
    public static function piante_trapianto_mese($actual_month) 
    {
        return Plant::whereJsonContains('trapianto',$actual_month)->get();
    }
}
