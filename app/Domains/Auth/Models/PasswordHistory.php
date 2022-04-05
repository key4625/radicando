<?php

namespace App\Domains\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

/**
 * Class PasswordHistory.
 */
class PasswordHistory extends Model
{
    use UsesTenantConnection;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'password_histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['password'];
}
