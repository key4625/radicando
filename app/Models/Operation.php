<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Operation extends Model
{
    use HasFactory;
    use UsesTenantConnection;
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
