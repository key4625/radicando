<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class Collection extends Model
{
    use HasFactory;
    use UsesTenantConnection;
    protected $guarded = [];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
    public function collectionable()
    {
        return $this->morphTo();
    }
}
