<?php

namespace App;

use DB;
use App\Document;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public static function get_reference_data($date_range)
	{
		$range = explode(' - ', $date_range);

		
		$data_documents = Document::with('truck', 'driver')
		->select('truck_id', 'total_weight', 'date_created')
		->where('date_created', '>=', $range[0])
		->where('date_created', '<=', $range[1])
		->orderBy('truck_id', 'DESC')
		->get();
		// dd($data_documents);
		return $data_documents;
		
	}

	public static function get_international_data($date_range)
	{
		$range = explode(' - ', $date_range);

		
		$data_documents = Document::with('truck', 'driver')
		->select('truck_id', 'total_weight', 'date_created')
		->where('date_created', '>=', $range[0])
		->where('date_created', '<=', $range[1])
		->where('is_international', '=', 1)
		->orderBy('truck_id', 'DESC')
		->get();
		// dd($data_documents);
		return $data_documents;
		
	}

	public static function get_trucks_for_spravka($office, $range)
	{

			return DB::table('trucks')
				->where('office_id', $office)
				->where(function($q_status) use($range){
					$q_status->where('status', 1)
						->orWhere('date_deactivated', '>', $range[0]);
				})				
				->select('id')
				->get();

	}

	public static function get_trucks_for_reference($date_range)
	{
		$range = explode(' - ', $date_range);

		$trucks = DB::table('documents')
				->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')
				->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')				
				->select('route_lists.truck_id')
				->where('documents.date_created', '>=', $range[0])
				->where('documents.date_created', '<=', $range[1])
				->where('route_lists.is_international', '=', 0)
				->groupBy('truck_id')	
				->get();
				
		return $trucks;

	}

	public static function get_trucks_for_noname($date_range, $office)
	{
		$range = explode(' - ', $date_range);


		$trucks = DB::table('documents')
				->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')
				->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')				
				->join('drivers as fd', 'fd.id', '=', 'route_lists.first_driver_id')				
				->select('route_lists.truck_id')
				->where('documents.date_created', '>=', $range[0])
				->where('documents.date_created', '<=', $range[1])
				->where('fd.office_id', $office)
				// ->where('route_lists.is_international', '=', 0)
				->groupBy('truck_id')	
				->get();
				
		return $trucks;

	}

	/**FILTERED BY DATE RANGE,
	* ACTIVE DRIVERS, 
	* OFFICE*/

	public static function get_trucks_for_international($date_range, $office)
	{
		$range = explode(' - ', $date_range);

		return DB::table('documents')	
			->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')
			->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')			
			->join('drivers as fd', 'route_lists.first_driver_id', '=', 'fd.id')			
			->select('route_lists.truck_id')
			->where('documents.date_created', '>=', $range[0])
			->where('documents.date_created', '<=', $range[1])
			->where('fd.office_id', $office)
			->where(function($fd_status) use($range){
				$fd_status->where('fd.status', 1)
					->orWhere('fd.date_deactivated', '>', $range[0]);
			})
			->where('route_lists.is_international', '=', 1)
			->groupBy('route_lists.truck_id')	
			->get();

	}

	public static function get_trucks_spravka_data($date_range, $office)
	{
		$data = [];
		// dd($office);
		$range = explode(' - ', $date_range);
		// dd($range);
		$trucks = self::get_trucks_for_spravka($office, $range);
			
		foreach ($trucks as $truck) {
// dd($truck->id);
			$data[$truck->id] = Document::groupBy('documents.date_created')
			->selectRaw('documents.date_created, sum(documents.total_weight) as sum_total_weight_by_day')
			->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')
			->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')
			->join('drivers as fd', 'fd.id', '=', 'route_lists.first_driver_id')
			->where('route_lists.truck_id', '=', $truck->id)
			->where('documents.date_created', '>=', $range[0])
			->where('documents.date_created', '<=', $range[1])	
			->where('fd.office_id', $office)		
			->where('route_lists.is_international', '=', 0)			
			->pluck('sum_total_weight_by_day', 'documents.date_created');
		}
		
		// dd($data);
			
		return $data;
	}

	public static function get_trucks_reference_data($date_range)
	{
		$data = [];
		
		$trucks = self::get_trucks_for_reference($date_range);
		
		$range = explode(' - ', $date_range);
		
		foreach ($trucks as $truck) {

			$data[$truck->truck_id] = Document::groupBy('documents.date_created')
			->selectRaw('documents.date_created, sum(documents.total_weight) as sum_total_weight_by_day')
			->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')
			->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')
			->where('route_lists.truck_id', '=', $truck->truck_id)
			->where('documents.date_created', '>=', $range[0])
			->where('documents.date_created', '<=', $range[1])			
			->where('route_lists.is_international', '=', 0)			
			->pluck('sum_total_weight_by_day', 'documents.date_created');
		}
	
		return $data;
	}

	public static function get_trucks_noname_data($date_range, $office)
	{
		$data = [];
		
		$trucks = self::get_trucks_for_noname($date_range, $office);
		
		$range = explode(' - ', $date_range);
		
		foreach ($trucks as $truck) {

			$data[$truck->truck_id] = Document::groupBy('documents.date_created')
			->selectRaw('documents.date_created, sum(documents.total_weight) as sum_total_weight_by_day')
			->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')
			->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')
			->join('drivers as fd', 'fd.id', '=', 'route_lists.first_driver_id')
			->where('fd.office_id', $office)
			->where('route_lists.truck_id', '=', $truck->truck_id)
			->where('documents.date_created', '>=', $range[0])
			->where('documents.date_created', '<=', $range[1])			
			// ->where('route_lists.is_international', '=', 0)			
			->pluck('sum_total_weight_by_day', 'documents.date_created');
		}
	
		return $data;
	}

	public static function get_trucks_international_data($date_range, $office)
	{
		$data = [];
		$trucks = self::get_trucks_for_international($date_range, $office);
		// dd($trucks);

		$range = explode(' - ', $date_range);
		// dd($trucks);

		foreach ($trucks as $truck) {
			$data[$truck->truck_id] = Document::groupBy('documents.date_created')
			->selectRaw('date_created, sum(total_weight) as sum_total_weight_by_day')
			->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')
			->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')
			->join('drivers as fd', 'route_lists.first_driver_id', '=', 'fd.id')	
			->where('route_lists.truck_id', '=', $truck->truck_id)
			->where('documents.date_created', '>=', $range[0])
			->where('documents.date_created', '<=', $range[1])	
			->where('fd.office_id', $office)
			->where(function($fd_status) use($range){
				$fd_status->where('fd.status', 1)
					->orWhere('fd.date_deactivated', '>', $range[0]);
			})	
			->where('route_lists.is_international', '=', 1)			
			->pluck('sum_total_weight_by_day', 'date_created');
		}
		// dd($data);
		return $data;
	}
	
	public static function get_documents_dates($date_range)
	{
		$range = explode(' - ', $date_range);

		return DB::table('documents')
		->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')
		->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')
		->select('documents.date_created')
		->where('documents.date_created', '>=', $range[0])
		->where('documents.date_created', '<=', $range[1])		
		->where('route_lists.is_international', '=', 0)		
		->groupBy('documents.date_created')	
		->get();
	}

	public static function get_documents_dates_for_noname($date_range, $office)
	{
		$range = explode(' - ', $date_range);

		return DB::table('documents')
		->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')
		->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')
		->join('drivers as fd', 'fd.id', '=', 'route_lists.first_driver_id')
		->select('documents.date_created')
		->where('documents.date_created', '>=', $range[0])
		->where('documents.date_created', '<=', $range[1])	
		->where('fd.office_id', $office)	
		// ->where('route_lists.is_international', '=', 0)		
		->groupBy('documents.date_created')	
		->get();
	}

	public static function get_spravka_documents_dates($date_range, $office)
	{
		$range = explode(' - ', $date_range);

		return DB::table('documents')
		->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')
		->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')	
		->join('drivers as fd', 'route_lists.first_driver_id', '=', 'fd.id')	
		->join('trucks', 'route_lists.truck_id', '=', 'trucks.id')	
		->select('documents.date_created')
		->where('documents.date_created', '>=', $range[0])
		->where('documents.date_created', '<=', $range[1])	
		->where('fd.office_id', $office)	
		->where('trucks.office_id', $office)	
		->where(function($t_status_query) use($range){
			$t_status_query->where('trucks.status', 1)
				->orWhere('trucks.date_deactivated', '>', $range[0]);
		})
		->where('route_lists.is_international', '=', 0)		
		->groupBy('documents.date_created')	
		->get();
	}	
	/** FILTER BY OFFICE, DRIVER STATUS, PERIOD*/

	public static function get_documents_dates_for_international($date_range, $office)
	{
		$range = explode(' - ', $date_range);

		return DB::table('documents')
		->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')				
		->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')	
		->join('drivers as fd', 'route_lists.first_driver_id', '=', 'fd.id')
		->select('documents.date_created')
		->where('documents.date_created', '>=', $range[0])
		->where('documents.date_created', '<=', $range[1])
		->where('fd.office_id', $office)
		->where(function($fd_status) use($range){
			$fd_status->where('fd.status', 1)
				->orWhere('fd.date_deactivated', '>', $range[0]);
		})
		->where('route_lists.is_international', '=', 1)
		->groupBy('documents.date_created')	
		->get();
	}	

	//RETRIEVES ACTIVE TRUCKS DATA FOR THE SELECTED PERIOD AND OFFICE

	public static function trucks_has_documents_for_spravka($date_range, $office)
	{
		$range = $range = explode(' - ', $date_range);
		$trucks = self::get_trucks_for_spravka($office, $range);
		// dd($trucks);
		$data = [];
		foreach ($trucks as $t) {
			$data[$t->id] = DB::table('trucks')
				->select('*')
				->where('id', '=', $t->id)
				->get();
		}

		return $data;
	}

	public static function trucks_has_documents($date_range)
	{
		$trucks = self::get_trucks_for_reference($date_range);
		// dd($trucks);
		$data = [];
		foreach ($trucks as $t) {
			$data[$t->truck_id] = DB::table('trucks')
				->select('*')
				->where('id', '=', $t->truck_id)
				->get();
		}

		return $data;
	}

	public static function trucks_has_documents_for_noname($date_range, $office)
	{
		$trucks = self::get_trucks_for_noname($date_range, $office);
		// dd($trucks);
		$data = [];
		foreach ($trucks as $t) {
			$data[$t->truck_id] = DB::table('trucks')
				->select('*')
				->where('id', '=', $t->truck_id)
				->get();
		}

		return $data;
	}

	public static function trucks_has_documents_for_international($date_range, $office)
	{
		
		$trucks = self::get_trucks_for_international($date_range, $office);

		$data = [];

		foreach ($trucks as $t) {
			$data[$t->truck_id] = DB::table('trucks')
				->select('*')
				->where('id', '=', $t->truck_id)
				->get();
		}

		return $data;
	}

	public static function get_trucks_total_weight_for_period_for_spravka($date_range, $office)
	{
		$data = [];
		$range = explode(' - ', $date_range);
		//trucks being filtered by date_range, status, officeget_spravka_documents_dates
		$trucks = self::get_trucks_for_spravka($office, $range);

		$range = explode(' - ', $date_range);
		
		foreach ($trucks as $truck) {
			$total_weight = Document::selectRaw(' sum(total_weight) as range_total_weight')
				->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')
				->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')
				->join('drivers as fd', 'fd.id', '=', 'route_lists.first_driver_id')
				->where('route_lists.truck_id', '=', $truck->id)
				->where('documents.date_created', '>=', $range[0])
				->where('documents.date_created', '<=', $range[1])
				->where('fd.office_id', $office)
				->where('route_lists.is_international', '=', 0)
				->get();

			$data[$truck->id] = $total_weight[0]->range_total_weight;
		}
		// dd(array_filter($data));
		return $data;
	}

	public static function get_trucks_total_weight_for_period($date_range)
	{
		$data = [];
		$trucks = self::get_trucks_for_reference($date_range);

		$range = explode(' - ', $date_range);
		
		foreach ($trucks as $truck) {
			$total_weight = Document::selectRaw(' sum(total_weight) as range_total_weight')
				->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')				
				->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')				
				->where('route_lists.truck_id', '=', $truck->truck_id)
				->where('documents.date_created', '>=', $range[0])
				->where('documents.date_created', '<=', $range[1])
				->where('route_lists.is_international', '=', 0)
				->get();

			$data[$truck->truck_id] = $total_weight[0]->range_total_weight;
		}
		// dd($data);
		return $data;
	}

	public static function get_trucks_total_weight_for_period_for_noname($date_range, $office)
	{
		$data = [];
		$trucks = self::get_trucks_for_noname($date_range, $office);

		$range = explode(' - ', $date_range);
		
		foreach ($trucks as $truck) {
			$total_weight = Document::selectRaw(' sum(total_weight) as range_total_weight')
				->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')				
				->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')	
				->join('drivers as fd', 'route_lists.first_driver_id', '=', 'fd.id')
				->where('route_lists.truck_id', '=', $truck->truck_id)				
				->where('fd.office_id', $office)
				->where(function($fd_status) use($range){
					$fd_status->where('fd.status', 1)
						->orWhere('fd.date_deactivated', '>', $range[0]);
				})
				->where('documents.date_created', '>=', $range[0])
				->where('documents.date_created', '<=', $range[1])
				// ->where('route_lists.is_international', '=', 0)
				->get();

			$data[$truck->truck_id] = $total_weight[0]->range_total_weight;
		}
		// dd($data);
		return $data;
	}

	public static function get_trucks_total_weight_for_period_international($date_range, $office)
	{
		$data = [];
		$trucks = self::get_trucks_for_international($date_range, $office);

		$range = explode(' - ', $date_range);
		// dd($trucks);

		foreach ($trucks as $truck) {
			$total_weight = Document::selectRaw(' sum(total_weight) as range_total_weight')
				->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')
				->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')
				->join('drivers as fd', 'route_lists.first_driver_id', '=', 'fd.id')				
				->where('route_lists.truck_id', '=', $truck->truck_id)
				->where('fd.office_id', $office)
				->where(function($fd_status) use($range){
					$fd_status->where('fd.status', 1)
						->orWhere('fd.date_deactivated', '>', $range[0]);
				})
				->where('documents.date_created', '>=', $range[0])
				->where('documents.date_created', '<=', $range[1])
				->where('route_lists.is_international', '=', 1)
				->get();
			// dd($total_weight[0]->range_total_weight);
			$data[$truck->truck_id] = $total_weight[0]->range_total_weight;
		}
		// dd($data);
		return $data;
	}
}
