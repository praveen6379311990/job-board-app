<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JobSeeker extends Authenticatable
{
    protected $fillable = ['name','email','phone','experience','notice_period','skills','location_id','resume','photo','password'];
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
