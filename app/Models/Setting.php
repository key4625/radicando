<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Setting extends Model
{
    use UsesTenantConnection;
    protected $guarded = [];
    protected $primaryKey = 'name';
    public $incrementing = false;
}
