<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class TrucksWeightCategory extends Model
{
    protected $fillable = ['name', 'payment'];

    public function trucks()
    {
    	return $this->hasMany('App\Truck');
    }

    public static function get_max_trucks_number_per_category($date_range, $office)
    {
        
        $range = explode(' - ', $date_range);
        
    	$result = DB::table('trucks')
            ->where('office_id', $office)
            ->where(function($status) use ($range){
                $status->where('status', 1)
                    ->orWhere('date_deactivated', '>', $range[0]);
            })
    		->selectRaw('(count(id)) as trucks')
    		->groupBy('trucks_weight_category_id')
    		->orderBy('trucks', 'DESC')
    		->first();

    	return $result->trucks;
    }
}
