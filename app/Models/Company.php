<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'logo', 'name', 'adress_line1', 'adress_line2', 'zip', 'province', 'city', 'country', 'owner_id'
    ];
}
