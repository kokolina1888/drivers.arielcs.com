<?php

namespace App;

use App\TrucksWeightCategory;
use DB;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $fillable = ['number', 'truck_load', 'trucks_weight_category_id', 'office_id'];

    public function trucks_weight_category()
    {
    	return $this->belongsTo('App\TrucksWeightCategory');
    }

    public static function trucks_by_weight_category($date_range, $office)
    {
        $range = explode(' - ', $date_range);
    	$truck_weight_categories = TrucksWeightCategory::with(['trucks' => function($query) use($office, $range){
            $query->where('trucks.office_id', $office)
            ->where(function($status) use($range){
                $status->where('status', 1)
                    ->orWhere('date_deactivated', '>', $range[0]);
            });
        }])
                ->get();
    	return $truck_weight_categories;
    }

    public function office()
    {
        return $this->belongsTo('App\Office');
    }

     public static function change_truck_status($id, $status)
    {
        if( $status == 0){
            DB::table('trucks')
                ->where('id', $id)
                ->update(['status' => 1,
                            'date_deactivated' => NULL]);
                return 1;
        }

        if( $status == 1){
            $date = date('Y-m-d');
            
            DB::table('trucks')
                ->where('id', $id)
                ->update(['status' => 0,
                        'date_deactivated' => $date]);
                return 0;
        }
    }

   
}
