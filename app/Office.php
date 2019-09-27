<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = ['name', 'is_sofia'];

    public function drivers()
    {
    	return $this->hasMany('App\Drivers');
    }

    public static function scopeProvince($query)
    {
    	return $query->where('is_sofia', 0);
    }
}
