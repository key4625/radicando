<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use Storage;
use Str;

class Plant extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UsesTenantConnection;
    protected $guarded = [];

    public function orders()
    {
        return $this->morphToMany(Order::class, 'orderable')->withPivot('quantity','quantity_um','price','price_um');
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
            if(Str::startsWith($this->image,'public/tenant/')){
                return Storage::url($this->image);
            } else return  $this->image;
        } else {  
            return "/img/img-placeholder.png";
        }    
    }
    /*public function getPriceAttribute($value)
    {
        return str_replace('.', ',', $value);
    }
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace(',', '.', $value);
    }*/

    public function raccolti_oggi_kg()
    {
        return Collection::where('collectionable_id',$this->id)->where('collectionable_type','App\Models\Plant')->whereDay('created_at', '=', date('d'))->sum('quantity');
    }
    public function raccolti_oggi_nr()
    {
        return Collection::where('collectionable_id',$this->id)->where('collectionable_type','App\Models\Plant')->whereDay('created_at', '=', date('d'))->sum('quantity');
    }
    public function raccolti_tot_kg()
    {
        return Collection::where('collectionable_id',$this->id)->where('collectionable_type','App\Models\Plant')->sum('quantity');
    }
    public function raccolti_tot_nr()
    {
        return Collection::where('collectionable_id',$this->id)->where('collectionable_type','App\Models\Plant')->sum('quantity');
    }
    public static function piante_semina_mese($actual_month) 
    {
        return Plant::whereJsonContains('semina',strval($actual_month))->get();
    }
    public static function piante_semina_out_mese($actual_month) 
    {
        return Plant::whereJsonContains('semina_out',strval($actual_month))->get();
    }
    public static function piante_trapianto_mese($actual_month) 
    {
        return Plant::whereJsonContains('trapianto',strval($actual_month))->get();
    }
}
