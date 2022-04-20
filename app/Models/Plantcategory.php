<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Plantcategory extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $guarded = [];

    
}
