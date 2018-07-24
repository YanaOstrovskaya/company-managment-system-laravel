<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    protected $fillable = [
        'birhdate', 'photo', 'job_start_date', 'phone', 'job_title'
    ];

}
