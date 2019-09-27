<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Driver extends Model
{
    protected $fillable = ['name', 'office_id', 'type'];

    public function office()
    {
    	return $this->belongsTo('App\Office');
    }

    // returns drivers based on office
    public static function get_drivers_by_office($id, $date_range)
    {
        $range = explode(' - ', $date_range);
    	return DB::table('drivers')
            ->join('offices', 'drivers.office_id', '=', 'offices.id')
            ->where(function($d_status) use($range){
                $d_status->where('drivers.status', 1)
                    ->orWhere('date_deactivated', '>', $range[0]);
            })
    		->where('drivers.office_id', $id)
    		->select('drivers.id', 'drivers.name as driver_name', 'offices.name as office_name')
            ->orderBy('driver_name', 'ASC')
    		->get();
    }

    // gets all drivers data for each day 
    //- total weight, num of recevers, 
    //out of sofia tours, order number for the tour of this day
    public static function get_drivers_to_day_data($drivers, $days)
    {
    	$data = [];
    	//key
    	//driver_id => [['driver_name'=>'name'], [day1=>data, day 2 =>data.]]...
    	foreach($drivers as $d){

    		//general data
    		$data[$d->id]['general'] = [ 'driver_name' => $d->driver_name, 'office_name' => $d->office_name ];
    		foreach($days as $day){
    			// total weight for the day without order    			
    			//total weight in sofia
    			$data[$d->id]['total_weight_in_sofia'][$day] = self::sum_total_weight_by_day($d, $day);
    			//num requests per the day in sofia
    			$data[$d->id]['num_requests_in_sofia'][$day] = self::num_requests_in_sofia_by_day($d, $day);
    			//total weight outside of sofia
    			
    			$data[$d->id]['total_weight_out_sofia'][$day] = self::sum_total_weight_by_day_out_sofia($d, $day);
    			//order numbers for outside sofia tours
    			$data[$d->id]['order_nums_out_sofia'][$day] = self::order_nums_out_sofia($d, $day);
    		}
    	}
    	// dd($data);
    	return $data;
    }

    public static function sum_total_weight_by_day($driver, $day)
    {
    		$sum_total_weight_by_day= DB::table('route_lists')
                                            ->join('document_route_list', 'route_lists.id', '=', 'document_route_list.route_list_id')            
    										->join('documents', 'document_route_list.document_id', '=', 'documents.id')
    										->where(function($q) use ($driver) {
            									$q->whereNull('route_lists.order_number')
            									   ->orWhere('route_lists.order_number', '')
            									   ->orWhere('route_lists.order_number', 0);
            								})
    										->where('route_lists.is_international', 0)
    										->where(function($q) use ($driver) {
            									$q->where('route_lists.first_driver_id', $driver->id)
            									   ->orWhere('route_lists.second_driver_id', $driver->id);
            								})
            								->where('documents.date_created', $day)
            								->selectRaw('documents.date_created, sum(documents.total_weight) as sum_total_weight_by_day')
    										->get();
    	
    	return $sum_total_weight_by_day[0]->sum_total_weight_by_day;
    }

    public static function num_requests_in_sofia_by_day($driver, $day)
    {
    		$sum_total_weight_by_day= DB::table('route_lists')
    										->join('document_route_list', 'route_lists.id', '=', 'document_route_list.route_list_id')            
                                            ->join('documents', 'document_route_list.document_id', '=', 'documents.id')                                        
    										->where(function($q) use ($driver) {
            									$q->whereNull('route_lists.order_number')
            									   ->orWhere('route_lists.order_number', '')
            									   ->orWhere('route_lists.order_number', 0);
            								})
    										->where('route_lists.is_international', 0)
    										->where(function($q) use ($driver) {
            									$q->where('route_lists.first_driver_id', $driver->id)
            									   ->orWhere('route_lists.second_driver_id', $driver->id);
            								})
            								->where('documents.date_created', $day)
            								->selectRaw('count(distinct(documents.receiver)) as num_requests')
    										->get();
    	
    	return $sum_total_weight_by_day[0]->num_requests;
    }

    public static function sum_total_weight_by_day_out_sofia($driver, $day)
    {
    		$sum_total_weight_by_day= DB::table('route_lists')
    										->join('document_route_list', 'route_lists.id', '=', 'document_route_list.route_list_id')            
                                            ->join('documents', 'document_route_list.document_id', '=', 'documents.id')                                        
                                            ->where(function($q) use ($driver) {
            									$q->whereNotNull('route_lists.order_number')
            									   ->where('route_lists.order_number', '<>', '')
            									   ->where('route_lists.order_number', '<>', 0);
            								})
    										->where('route_lists.is_international', 0)
    										->where(function($q) use ($driver) {
            									$q->where('route_lists.first_driver_id', $driver->id)
            									   ->orWhere('route_lists.second_driver_id', $driver->id);
            								})
            								->where('documents.date_created', $day)
            								// ->selectRaw('distinct(route_lists.id)')
            								->selectRaw('documents.date_created, sum(documents.total_weight) as sum_total_weight_by_day')
    										->get();
    	
    	// return $sum_total_weight_by_day;
    	return $sum_total_weight_by_day[0]->sum_total_weight_by_day;
    }

    //  public static function order_nums_out_sofia($driver, $day)
    // {
    // 		$order_numbers = DB::table('route_lists')
    // 										->join('documents', 'route_lists.id', '=', 'documents.route_list_id')
    // 										->where(function($q) use ($driver) {
    //         									$q->whereNotNull('route_lists.order_number')
    //         									   ->where('route_lists.order_number', '<>', '')
    //         									   ->where('route_lists.order_number', '<>', 0);
    //         								})
    // 										->where('route_lists.is_international', 0)
    // 										->where(function($q) use ($driver) {
    //         									$q->where('route_lists.first_driver_id', $driver->id)
    //         									   ->orWhere('route_lists.second_driver_id', $driver->id);
    //         								})
    //         								->where('documents.date_created', $day)
    //         								->selectRaw('distinct(route_lists.order_number)')
    // 										->get()
    // 										->toArray();
    	
    // 	// return $sum_total_weight_by_day;
    // 	return $order_numbers;
    // }

      public static function order_nums_out_sofia($driver, $day)
    {
        // dd($driver);
            $order_numbers = DB::table('route_lists')
                                            ->join('document_route_list', 'route_lists.id', '=', 'document_route_list.route_list_id')            
                                            ->join('documents', 'document_route_list.document_id', '=', 'documents.id')                                        
                                            ->join('orders', 'route_lists.id', '=', 'orders.route_list_id')
                                            ->where('orders.driver_id', $driver->id)
                                            ->where('route_lists.is_international', 0)
                                            ->where('documents.date_created', $day)
                                            ->selectRaw('DISTINCT(orders.order_number), documents.date_created')
                                            ->get()
                                            ->toArray();
        
        // return $sum_total_weight_by_day;
                                            // dd($order_numbers);
        return $order_numbers;
    }

    // all drivers data for a period - 
            //  total weight in sofia, 
            //num of unique recevers in sofia, 
            //sum of out of sofia tours, 
            //num of each type of trucks by weight category driven by order number
    public static function get_drivers_data_for_period($drivers, $date_range, $truck_weight_category)
    {
        $data = [];
        //key
        //driver_id => [['driver_name'=>'name'], [day1=>data, day 2 =>data.]]...
        foreach($drivers as $d){
            //general data
            $data[$d->id]['general'] = [ 'driver_name' => $d->driver_name, 'office_name' => $d->office_name ];            
            // total weight for period without order - in Sofia             
            //total weight in sofia
            $data[$d->id]['total_weight_in_sofia'] = self::sum_total_weight_for_period($d, $date_range);
            //num requests for the period in sofia - unique receivers
            $data[$d->id]['num_requests_in_sofia'] = self::num_requests_in_sofia_for_period($d, $date_range);
            // num order_numbers for period
            $data[$d->id]['num_order_numbers'] = self::num_order_numbers_for_period($d, $date_range);
            //num orders per truck weight category
            $data[$d->id]['num_order_numbers_per_truck_weight_category'] = self::num_order_numbers_per_truck_weight_category_for_period($d, $date_range, $truck_weight_category);
                
            //     $data[$d->id]['total_weight_out_sofia'][$day] = self::sum_total_weight_by_day_out_sofia($d, $day);
            //     //order numbers for outside sofia tours
            //     $data[$d->id]['order_nums_out_sofia'][$day] = self::order_nums_out_sofia($d, $day);;
           
        }
        // dd($data);
        return $data;
    }

    //total weight for period in sofia

    public static function sum_total_weight_for_period($driver, $date_range)
    {
        $date_range = explode(' - ', $date_range);
        
        $sum_total_weight = DB::table('route_lists')
                                ->join('document_route_list', 'route_lists.id', '=', 'document_route_list.route_list_id')            
                                ->join('documents', 'document_route_list.document_id', '=', 'documents.id')                                        
                                ->where(function($q) use ($driver) {
                                    $q->whereNull('route_lists.order_number')
                                        ->orWhere('route_lists.order_number', '')
                                        ->orWhere('route_lists.order_number', 0);
                                    })
                                ->where('route_lists.is_international', 0)
                                ->where(function($q) use ($driver) {
                                    $q->where('route_lists.first_driver_id', $driver->id)
                                        ->orWhere('route_lists.second_driver_id', $driver->id);
                                })
                                ->where('documents.date_created', '>=', $date_range[0])
                                ->where('documents.date_created', '<=', $date_range[1])
                                ->selectRaw('sum(documents.total_weight) as sum_total_weight')
                                ->get();
        
        return $sum_total_weight[0]->sum_total_weight;
    }

    //num of requests in sofia for period
    public static function num_requests_in_sofia_for_period($driver, $date_range)
    {
        $date_range = explode(' - ', $date_range);
        $result = DB::table('route_lists')
                            ->join('document_route_list', 'route_lists.id', '=', 'document_route_list.route_list_id')            
                            ->join('documents', 'document_route_list.document_id', '=', 'documents.id')                                        
                            ->where(function($q) use ($driver) {
                                $q->whereNull('route_lists.order_number')
                                   ->orWhere('route_lists.order_number', '')
                                   ->orWhere('route_lists.order_number', 0);
                            })
                            ->where('route_lists.is_international', 0)
                            ->where(function($q) use ($driver) {
                                $q->where('route_lists.first_driver_id', $driver->id)
                                   ->orWhere('route_lists.second_driver_id', $driver->id);
                            })
                            ->where('documents.date_created', '>=', $date_range[0])
                            ->where('documents.date_created', '<=', $date_range[1])                            
                            ->selectRaw('count(distinct(documents.receiver)) as num_requests')
                            ->groupBy('documents.date_created')
                            ->get()
                            ->toArray();
      $sum_total_requests = array_sum(array_column($result, 'num_requests'));
       // dd($result);
        return $sum_total_requests;
    }

    //returns num of unique order numbers for a period
    public static function num_order_numbers_for_period($driver, $date_range)
    {
        $date_range = explode(' - ', $date_range);
        $order_numbers = DB::table('route_lists')
                            ->join('document_route_list', 'route_lists.id', '=', 'document_route_list.route_list_id')            
                            ->join('documents', 'document_route_list.document_id', '=', 'documents.id')                                        
                            ->where(function($q) use ($driver) {
                                $q->whereNotNull('route_lists.order_number')
                                   ->where('route_lists.order_number', '<>', '')
                                   ->where('route_lists.order_number', '<>', 0);
                            })
                            ->where('route_lists.is_international', 0)
                            ->where(function($q) use ($driver) {
                                $q->where('route_lists.first_driver_id', $driver->id)
                                   ->orWhere('route_lists.second_driver_id', $driver->id);
                            })
                            ->where('documents.date_created', '>=', $date_range[0])
                            ->where('documents.date_created', '<=', $date_range[1])                            
                            ->selectRaw('count(distinct(route_lists.order_number)) as num_orders')
                            ->get()
                            ->toArray();
        
        // return $sum_total_weight_by_day;
        return $order_numbers[0]->num_orders;

    }

    public static function num_order_numbers_per_truck_weight_category_for_period($driver, $date_range, $truck_weight_category)
    {
        $date_range = explode(' - ', $date_range);
        $num_orders_per_truck_weight_category = [];
        foreach($truck_weight_category as $twc){
            $order_numbers_per_category = DB::table('route_lists')
                                        ->join('document_route_list', 'route_lists.id', '=', 'document_route_list.route_list_id')            
                                        ->join('documents', 'document_route_list.document_id', '=', 'documents.id')                                        
                                        ->join('trucks', 'route_lists.truck_id', '=', 'trucks.id')
                                        ->where(function($q) use ($driver) {
                                            $q->whereNotNull('route_lists.order_number')
                                               ->where('route_lists.order_number', '<>', '')
                                               ->where('route_lists.order_number', '<>', 0);
                                        })
                                        ->where('route_lists.is_international', 0)
                                        ->where('trucks.trucks_weight_category_id', $twc->id)
                                        ->where(function($q) use ($driver) {
                                            $q->where('route_lists.first_driver_id', $driver->id)
                                               ->orWhere('route_lists.second_driver_id', $driver->id);
                                        })
                                        ->where('documents.date_created', '>=', $date_range[0])
                                        ->where('documents.date_created', '<=', $date_range[1])                            
                                        ->selectRaw('count(distinct(route_lists.order_number)) as num_orders')
                                        ->get()
                                        ->toArray();
            $num_orders_per_truck_weight_category[$twc->id] = $order_numbers_per_category[0]->num_orders;             
        }
        // dd($num_orders_per_truck_weight_category);
        return $num_orders_per_truck_weight_category;
    }

    // all province drivers in sofia data data for a period - 
            //days with tours in sofia
            // total weight in sofia per day, 
            //num of unique recevers in sofia per day, 
           
    public static function get_province_drivers_in_sofia_data($drivers, $range)
    {
        $data = [];
        $ind = 0;

        foreach($drivers as $d){
            //check if data exists for current driver
            $check = self::data_in_sofia_per_day($d, $range); 
              
            if(count($check) > 0){ 
            // dd(count($data[$ind]['data_in_sofia_per_day']));  

            $data[$ind]['general'] = [ 'driver_name' => $d->name ];            
            $data[$ind]['data_in_sofia_per_day'] = $check;
            $data[$ind]['total'] = self::total_in_sofia_per_period($d, $range);    

            $ind++;  
            }     
        } 
        // dd($data);    
        return $data;
    }
    //province driver
    public static function data_in_sofia_per_day($driver, $range)
    {
             
        $data = DB::table('route_lists')
                                ->join('document_route_list', 'route_lists.id', '=', 'document_route_list.route_list_id')            
                                ->join('documents', 'document_route_list.document_id', '=', 'documents.id')                                        
                                ->where(function($q) use ($driver) {
                                    $q->whereNull('route_lists.order_number')
                                        ->orWhere('route_lists.order_number', '')
                                        ->orWhere('route_lists.order_number', 0);
                                    })
                                ->where('route_lists.is_international', 0)
                                ->where(function($q) use ($driver) {
                                    $q->where('route_lists.first_driver_id', $driver->id)
                                        ->orWhere('route_lists.second_driver_id', $driver->id);
                                })
                                ->where('documents.date_created', '>=', $range[0])
                                ->where('documents.date_created', '<=', $range[1])
                                ->selectRaw('sum(documents.total_weight) as sum_total_weight, documents.date_created, count(distinct(documents.receiver)) as requests')
                                ->groupBy('documents.date_created')
                                ->orderBy('documents.date_created', 'ASC')
                                ->get();
        return $data;
    }

    //province driver

    public static function total_in_sofia_per_period($driver, $range)
    {
              
        $data = DB::table('route_lists')
                                ->join('document_route_list', 'route_lists.id', '=', 'document_route_list.route_list_id')            
                                ->join('documents', 'document_route_list.document_id', '=', 'documents.id')                                        
                                ->where(function($q) use ($driver) {
                                    $q->whereNull('route_lists.order_number')
                                        ->orWhere('route_lists.order_number', '')
                                        ->orWhere('route_lists.order_number', 0);
                                    })
                                ->where('route_lists.is_international', 0)
                                ->where(function($q) use ($driver) {
                                    $q->where('route_lists.first_driver_id', $driver->id)
                                        ->orWhere('route_lists.second_driver_id', $driver->id);
                                })
                                ->where('documents.date_created', '>=', $range[0])
                                ->where('documents.date_created', '<=', $range[1])
                                ->selectRaw('sum(documents.total_weight) as sum_total_weight, count(distinct(documents.receiver)) as requests')
                                ->get()
                                ->toArray();
        
        return $data;
    }

    public static function add_order_to_driver($route_list_id, $order, $driver, $type)
    {
        
        DB::table('orders')->insert(
            ['order_number'     => $order, 
                'driver_id'     => $driver,
                'route_list_id' => $route_list_id,
                'type'      => $type
            ]
        );

        return true;
    }

    public static function remove_orders_from_route_list($id)
    {
       DB::table('orders')->where('orders.route_list_id', $id)->delete();
       return true;
    }

    public static function change_driver_status($id, $status)
    {
        if( $status == 0){
            DB::table('drivers')
                ->where('id', $id)
                ->update(['status' => 1,
                            'date_deactivated' => NULL]);
                return 1;
        }

        if( $status == 1){
            $date = date('Y-m-d');
            
            DB::table('drivers')
                ->where('id', $id)
                ->update(['status' => 0,
                        'date_deactivated' => $date]);
                return 0;
        }
    }
}
