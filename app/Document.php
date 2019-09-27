<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Document extends Model
{
	protected $fillable = [	
		'route_list_id',	
		'date_created',
		'document_number',
		'total_weight',
		'sender',
		'receiver',
		'receiver_address',	
		'sales_data_id'	
	];
         
	// public function route_list()
	// {
	// 	return $this->belongsTo('App\RouteList');
	// }
	public function route_lists()
	{
		return $this->belongsToMany('App\RouteList')->withPivot('is_repeated');
	}



	public function sales_data()
	{
		return $this->belongsTo('App\SalesData');
	}

	static public function remove_handenterd_pivot_data($id)
	{
		 DB::table('document_route_list')
          ->where('route_list_id', $id)
          ->delete();

          return true;
	}
	/** 
	*Get documents ids of distonct document number
	*@param array of unique document_ids
	*@return array of unique documents ids with unique numbers
	*/

	static public function get_distinct_numbers_ids($doc_ids)
	{
		$data = self::select('id')
   			->whereIn('id', $doc_ids)
   			->groupBy('document_number')
    		->get()
    		->toArray();
    		$data_plain = array_column($data, 'id');
    	
    	return $data_plain;
	}

	static public function check_if_repeated_document($doc_id)
	{
		
		$current_doc_num = DB::table('documents')->where('id', $doc_id)->select('document_number')->first();
		$results = DB::table('documents')
   				->join('document_route_list as drl', 'documents.id', '=', 'drl.document_id')
   				->where('documents.document_number', $current_doc_num->document_number)
   				->select('*')
   				->get();

   		foreach ($results as $drl) {

   			DB::table('document_route_list')
   				->where('route_list_id', $drl->route_list_id)
   				->where('document_id', $drl->document_id)
   				->update(['is_repeated' => 1]);	
   		}
   				//dd($results);
   		if($results->count()){
   			return true;
   		} else {
   			return false;
   		}
		
	}

	public static function get_documents_to_append($search)
	{
		return DB::table('documents')
			->where('document_number', 'LIKE', '%'.$search.'%')
			// ->whereNull('route_list_id')
			->orderBy('document_number')
			->get(['id','document_number', 'total_weight']);
	}

	//returns days within a date range 
	//with documents with route_lists_id not null
	//where driver first is from selected office

	public static function get_days_with_routes($date_range, $office)
	{
		$range = explode(' - ', $date_range);

		$data = Document::groupBy('documents.date_created')
			->selectRaw('documents.date_created')
			->join('document_route_list', 'documents.id', '=', 'document_route_list.document_id')
			->join('route_lists', 'document_route_list.route_list_id', '=', 'route_lists.id')
			->join('drivers as fd', 'route_lists.first_driver_id', '=', 'fd.id')
			->where('documents.date_created', '>=', $range[0])
			->where('documents.date_created', '<=', $range[1])			
			->where('route_lists.is_international', '=', 0)	
			->where('fd.office_id', $office)
			->orderBy('documents.date_created', 'ASC')
			->get()
			->toArray();
			return array_pluck($data, 'date_created');
	}
}
