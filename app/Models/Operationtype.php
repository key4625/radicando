<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Operationtype extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $guarded = [];
    public $timestamps = false;

    public function operations()
    {
        return $this->hasMany(Operations::class);
    }
}
