<?php

namespace App\Models;

use Spatie\Multitenancy\Models\Tenant;

class CustomTenantModel  extends Tenant
{
    protected $table = "tenants";

    protected static function booted()
    {
        static::creating(
            function (CustomTenantModel  $model) { 
                 return $model->createDatabase();
            }
        );
        //static::creating(fn(TenantModel $model) => $model->createDatabase());
    }

    public function createDatabase()
    {
        // add logic to create database
    }
}
