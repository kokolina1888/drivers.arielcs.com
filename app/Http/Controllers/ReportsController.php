<?php

namespace App\Http\Controllers;

use App\Truck;
use App\Driver;
use App\Office;
use App\Report;
use App\Document;
use Illuminate\Http\Request;
use App\TrucksWeightCategory;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\DriversToDaysReportRequest;


class ReportsController extends Controller
{
	public function original_index()
	{
		$offices = Office::all();
		return view('reports.original.init', compact('offices'));
	}

	public function international_index()
	{
		$offices = Office::all();
		return view('reports.international.init', compact('offices'));
	}

	public function noname_index()
	{
		$offices = Office::all();
		return view('reports.noname.init', compact('offices'));
	}

	public function spravka_index()
	{
		$offices = Office::all();
		return view('reports.spravka.init', compact('offices'));
	}	

	public function drivers_to_days_index()
	{
		$offices = Office::all();
		return view('reports.drivers_to_days.init', compact('offices'));
	}

	public function drivers_for_period_index()
	{
		$offices = Office::all();
		return view('reports.drivers_for_period.init', compact('offices'));
	}

	//

	public function province_drivers_in_sofia_index()
	{
		$offices = Office::province()->get();
		
		return view('reports.province_drivers_in_sofia.init', compact('offices'));
	}

	public function original_view()
	{
		try{
			$date_range = request('date');
			$office	= request('office');
			$office_data = Office::find($office);
        	$documents = self::get_data_for_original($date_range, $office);   


			return view('reports.original.view', compact('documents', 'date_range', 'office', 'office_data'));

		} catch(\Exception $exception) {

           //new 10.11.2018
        // if($exception->getMessage() == 'Undefined offset: 0'){
        //     return back()->withInput()
        //     ->with('message','Празни колони в категориите! Премахнете ги и опитайте отново!');
        // }
            //end 10.11.2018
            // return back()->withInput()
                        // ->with('message','Невалидни данни! Опитайте отново!');
			return $exception->getMessage();
		}
	}

	public function international_view()
	{
		try{
			
			$date_range = request('date');

			$office	= request('office');
			$office_data = Office::find($office);

        	$data = self::get_data_for_international($date_range, $office);

			return view('reports.international.view', compact('data', 'truck_total_weight', 'date_range', 'office', 'office_data'));

		} catch(\Exception $exception) {

        //end 10.11.2018
            // return back()->withInput()
                        // ->with('message','Невалидни данни! Опитайте отново!');
			return $exception->getMessage();
		}
	}

	public function noname_view()
	{
		try{
			
			$date_range = request('date');
			$office	= request('office');
			$office_data = Office::find($office);

        	$data = self::get_data_for_noname($date_range, $office);

			return view('reports.noname.view', compact('data', 'truck_total_weight', 'date_range', 'office', 'office_data'));

		} catch(\Exception $exception) {

           //end 10.11.2018
            // return back()->withInput()
                        // ->with('message','Невалидни данни! Опитайте отново!');
			return $exception->getMessage();
		}
	}

	public function spravka_view()
	{
		try{
			$date_range = request('date');
			$office	= request('office');
			$office_data = Office::find($office);

        	$data = self::get_data_for_spravka($date_range, $office);

			return view('reports.spravka.view', compact('data', 'truck_total_weight', 'date_range', 'office', 'office_data'));

		} catch(\Exception $exception) {

           // return back()->withInput()
                        // ->with('message','Невалидни данни! Опитайте отново!');
			return $exception->getMessage();
		}
	}

	
	

	public function drivers_to_days_view(DriversToDaysReportRequest $request)
	{
		try{
			
			$date_range = $request->date;
			$office	= $request->office;
			$office_data = Office::find($office);
			
        	$data = self::get_data_for_drivers_to_days($date_range, $office);

			return view('reports.drivers_to_days.view', compact('data', 'date_range', 'office', 'office_data'));

		} catch(\Exception $exception) {

        //end 10.11.2018
            // return back()->withInput()
                        // ->with('message','Невалидни данни! Опитайте отново!');
			return $exception->getMessage();
		}
	}


	public function drivers_for_period_view(DriversToDaysReportRequest $request)
	{
		try{
			
			$date_range = $request->date;
			$office	= $request->office;

			$office = Office::findOrFail($office);
			
        	$data = self::get_data_for_drivers_for_period($date_range, $office);

			return view('reports.drivers_for_period.view', compact('data', 'date_range', 'office'));

		} catch(\Exception $exception) {

        //end 10.11.2018
            // return back()->withInput()
                        // ->with('message','Невалидни данни! Опитайте отново!');
			return $exception->getMessage();
		}
	}

	public function province_drivers_in_sofia_view(Request $request)
	{
		try{
			
			$date_range = $request->date;
			$office_id	= 1; //Sofia		
			
        	$data = self::get_province_drivers_in_sofia_data($date_range);
        	
			return view('reports.province_drivers_in_sofia.view', compact('data', 'date_range', 'office_id'));

		} catch(\Exception $exception) {

        //end 10.11.2018
            // return back()->withInput()
                        // ->with('message','Невалидни данни! Опитайте отново!');
			return $exception->getMessage();
		}
	}

	public function export_province_drivers_in_sofia(Request $request)
	{
		// dd($request);
		$date_range = $request->date;
		// dd($date_range);
		// $office_ids	= $request->office;
		// $office_ids = explode('-', $office_ids);

		// $offices = Office::whereIn('id', $office_ids)->get();			
			
        $data = self::get_province_drivers_in_sofia_data($date_range);
		

		// dd($date_range);
		$dr = str_replace(' ', '', $date_range);
		$dr = str_replace('-', '_', $dr);
		// dd($dr);
		$filename = 'province_drivers_in_sofia_' . $dr;

		

		Excel::create($filename, function($excel) use ($data, $filename) {

			$excel->sheet('New sheet', function($sheet) use($data, $filename) {

				$sheet->loadView('reports.province_drivers_in_sofia.view_for_export', [ 'data' => $data ]);

			});

		})->download('xlsx');

		return true;		
	}

	public function export_original()
	{

		$date_range = request('date_range');
		$office_id = request('office');
		// dd($office_id);

		// dd($date_range);
		$dr = str_replace(' ', '', $date_range);
		$dr = str_replace('-', '_', $dr);
		// dd($dr);
		$filename = 'original_' . $dr;
		// dd($filename);		

		$data = self::get_data_for_original($date_range, $office_id);

		Excel::create($filename, function($excel) use ($data, $filename) {

			$excel->sheet('New sheet', function($sheet) use($data, $filename) {

				$sheet->loadView('reports.original.view_for_export', [ 'documents' => $data]);

			});

		})->download('xlsx');

		return true;

		
	}

	public function export_international()
	{

		$date_range = request('date_range');
		$office = request('office');
		// dd($office);

		// dd($date_range);
		$dr = str_replace(' ', '', $date_range);
		$dr = str_replace('-', '_', $dr);
		// dd($dr);
		$filename = 'international_' . $dr;
			

		$data = self::get_data_for_international($date_range, $office);

		Excel::create($filename, function($excel) use ($data, $filename) {

			$excel->sheet('New sheet', function($sheet) use($data, $filename) {

				$sheet->loadView('reports.international.view_for_export', [ 'data' => $data]);

			});

		})->download('xlsx');

		return true;		
	}

	public function export_noname()
	{

		$date_range = request('date_range');
		$office = request('office');

		$dr = str_replace(' ', '', $date_range);
		$dr = str_replace('-', '_', $dr);
		// dd($dr);
		$filename = 'bez_ime_' . $dr;
		
		$data = self::get_data_for_noname($date_range, $office);

		Excel::create($filename, function($excel) use ($data, $filename) {

			$excel->sheet('New sheet', function($sheet) use($data, $filename) {

				$sheet->loadView('reports.noname.view_for_export', [ 'data' => $data]);

			});

		})->download('xlsx');

		return true;		
	}

	
	public function export_spravka()
	{

		$date_range = request('date_range');
		$office = request('office');

		// dd($date_range);
		$dr = str_replace(' ', '', $date_range);
		$dr = str_replace('-', '_', $dr);
		// dd($dr);
		$filename = 'spravka_' . $dr;
		// dd($filename);		

		$data = self::get_data_for_spravka($date_range, $office);

		Excel::create($filename, function($excel) use ($data, $filename) {

			$excel->sheet('New sheet', function($sheet) use($data, $filename) {

				$sheet->loadView('reports.spravka.view_for_export', [ 'data' => $data]);

			});

		})->download('xlsx');

		return true;

		
	}

	

	

	public function export_drivers_to_days(DriversToDaysReportRequest $request)
	{

		$date_range = $request->date_range;
		$office_id = $request->office;

		// dd($date_range);
		$dr = str_replace(' ', '', $date_range);
		$dr = str_replace('-', '_', $dr);
		// dd($dr);
		$filename = 'drivers_to_days_' . $dr;
			

		$data = self::get_data_for_drivers_to_days($date_range, $office_id);

		Excel::create($filename, function($excel) use ($data, $filename) {

			$excel->sheet('New sheet', function($sheet) use($data, $filename) {

				$sheet->loadView('reports.drivers_to_days.view_for_export', [ 'data' => $data]);

			});

		})->download('xlsx');

		return true;		
	}

	public function export_drivers_for_period(DriversToDaysReportRequest $request)
	{

		$date_range = $request->date_range;
		$office_id = $request->office;

		// dd($date_range);
		$dr = str_replace(' ', '', $date_range);
		$dr = str_replace('-', '_', $dr);
		// dd($dr);
		$filename = 'drivers_for_period_' . $dr;

		$office = Office::findOrFail($office_id);			

		$data = self::get_data_for_drivers_for_period($date_range, $office);

		Excel::create($filename, function($excel) use ($data, $filename, $office) {

			$excel->sheet('New sheet', function($sheet) use($data, $filename, $office) {

				$sheet->loadView('reports.drivers_for_period.view_for_export', [ 'data' => $data, 'office' => $office ]);

			});

		})->download('xlsx');

		return true;		
	}


	public static function get_data_for_original($date_range, $office_id)
	{
		$range = explode(' - ', $date_range);
		
//get documents - where first and second driver`s office is equeal to office id
		$documents = Document::with(['route_lists',
									'route_lists.truck',
									'route_lists.first_driver',
									'route_lists.second_driver'
									])
							->where('date_created', '>=', $range[0])
							->where('date_created', '<=', $range[1])
							->whereHas('route_lists', function($query) use ($office_id, $range){
								$query->whereHas('first_driver', function( $first_d_query) use ($office_id, $range){
									$first_d_query->where('office_id', $office_id)
												->where(function($f_status) use($range){
													$f_status->where('status', 1)
															->orWhere('date_deactivated', '>', $range[0]);
												});
								});								
							})//whereHas
							->get();
							// dd($documents);	
		
		return $documents;
	}

	/** DATA FOR INTERNATIONAL
	** FILTERED BY OFFICE
	** ONLY FOR ACTIVE DRIVERS DURING SELECTED PERIOD
	*/

	public static function get_data_for_international($date_range, $office)
	{
		$data = [];
		//truck weight for period by day
		$data['documents_truck_data'] = Report::get_trucks_international_data($date_range, $office);
			// dd($data['documents_truck_data']);
		$data['documents_dates'] = Report::get_documents_dates_for_international($date_range, $office);
		// dd($data['documents_dates']);
			//trucks and numbers
		$data['document_trucks'] = Report::trucks_has_documents_for_international($date_range, $office);
		// dd($data['document_trucks']);
			//truck total weight for period
		$data['truck_total_weight'] = Report::get_trucks_total_weight_for_period_international($date_range, $office);
			// dd($data['truck_total_weight']);

		return $data;
	}

	public static function get_data_for_noname($date_range, $office)
	{
		$data = [];
		//truck weight for period by day
		$data['documents_truck_data'] = Report::get_trucks_noname_data($date_range, $office);
		// dd($data['documents_truck_data']);
		$data['documents_dates'] = Report::get_documents_dates_for_noname($date_range, $office);
		// dd($data['documents_dates']);
		//trucks and numbers
		$data['document_trucks'] = Report::trucks_has_documents_for_noname($date_range, $office);
		// dd($data['document_trucks']);
			//truck total weight for period
		$data['truck_total_weight'] = Report::get_trucks_total_weight_for_period_for_noname($date_range, $office);
			// dd($data['truck_total_weight']);
		// dd($data);
		return $data;
	}

	public static function get_data_for_spravka($date_range, $office)
	{
		$data = [];
		//all trucks weight for period by day no international
		$data['documents_truck_data'] = Report::get_trucks_spravka_data($date_range, $office);
		
		$data['documents_dates'] = Report::get_spravka_documents_dates($date_range, $office);
		// dd($data['documents_dates']);
		//trucks and numbers !!!!! MUST BE FILTERED BY OFFICE !!!! 
		$data['document_trucks'] = Report::trucks_has_documents_for_spravka($date_range, $office);
		// dd($data['document_trucks']);
			//truck total weight for period
		$data['truck_total_weight'] = Report::get_trucks_total_weight_for_period_for_spravka($date_range, $office);
			// dd($data['truck_total_weight']);

		return $data;
	}
	

	public static function get_data_for_drivers_to_days($date_range, $office)
	{
		$data = []; 
		$data['drivers'] 	= Driver::get_drivers_by_office($office, $date_range);

		//days within a period with documents with route_list_id != null
		$data['days']		= Document::get_days_with_routes($date_range, $office);
		// dd($data['days']);
		$data['days_count'] = count($data['days']);
		// all drivers data for each day - total weight, num of recevers, out of sofia tours, order number for the tour of this day
		$data['drivers_to_day'] = Driver::get_drivers_to_day_data($data['drivers'], $data['days']);
		//days with tours for the period
		// dd($data);
		return $data;
	}

	public static function get_data_for_drivers_for_period($date_range, $office)
	{
		// dd($office->id);
		$data = []; 
		$data['drivers'] 	= Driver::get_drivers_by_office($office->id, $date_range);

		$data['trucks_by_weight_category'] = Truck::trucks_by_weight_category($date_range, $office->id);
		// dd($data['trucks_by_weight_category']);
		//truck category with max truck for printing trucks
		$data['trucks_weight_category_max_trucks'] = TrucksWeightCategory::get_max_trucks_number_per_category($date_range, $office->id);	
		
		$data['drivers_for_period'] = Driver::get_drivers_data_for_period($data['drivers'], $date_range, $data['trucks_by_weight_category']);
				// dd($data['drivers_for_period']);
		return $data;
	}

	public static function get_province_drivers_in_sofia_data($date_range)
	{
		$data = []; 
		$range = explode(' - ', $date_range);
		$data['drivers'] 	= Driver::where('office_id', 1)
							->where('type', 2)
							->where(function($status_query) use($range){
								$status_query->where('status', 1)
											->orWhere('date_deactivated', '>', $range[0]);
								})
							->get();	
		// dd($data['drivers']);
		// all drivers data for each day - total weight, num of recevers, out of sofia tours, order number for the tour of this day
		$data['province_drivers_in_sofia'] = Driver::get_province_drivers_in_sofia_data($data['drivers'], $range);
		
		return $data;
	}

	
}
