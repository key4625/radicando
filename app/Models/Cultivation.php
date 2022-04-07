<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Cultivation extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $guarded = [];

    public function cultivable()
    {
        return $this->morphTo();
    }
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
    public static function filtra_attive()
    {
       return Cultivation::where('data_fine', '>',NOW())->orwhere('data_fine',null);
    }
    public function getFormattedDataFine(){
        if($this->data_fine!=null){
            $datenow = Carbon::now();
            $dateend = Carbon::parse($this->data_fine );
            $diff = $datenow->diffInDays($dateend);
            if ($dateend->isPast()){
                $data_formatted = $dateend->format('d M Y');
            } else {
                $data_formatted = '<span class="text-success">'.$dateend->format('d M Y').'</span>';
            }
        } else  $data_formatted = '<span class="text-info">non specificata</span>';
        return $data_formatted;
    }

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }
    
}
