<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;

class Contact extends Model
{
    use UsesLandlordConnection;
    use HasFactory;
    protected $guarded = [];
}
