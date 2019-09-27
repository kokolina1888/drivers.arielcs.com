<?php

namespace App;

use DB;
use App\Document;
use Illuminate\Database\Eloquent\Model;

class RouteList extends Model
{
    protected $fillable = [
		'order_number',		
		'order_number2',		
		'route_list_number',		
		'first_driver_id',
		'second_driver_id',
		'km_start',
		'km_end',
		'truck_id',		
		'note',
		'gas_quant',
		'km_run',
		'is_handentered',
		'is_international',
		'is_foreign',
		
	];

	public function first_driver()
	{
		return $this->belongsTo('App\Driver');
	}

	public function second_driver()
	{
		return $this->belongsTo('App\Driver');
	}

	public function truck()
	{
		return $this->belongsTo('App\Truck');
	}

	public function documents()
	{
		// return $this->hasMany('App\Document');
		return $this->belongsToMany('App\Document');
	}

	//DELETES IN TABLE DOCUMENTS ROUTE LIST
	//WHERE ROUTE LIST ID = @param @route_list_id and document id
	//@param - route list id - int
	//@param - $documents - array of doument ids
	//update is repeated 

	static public function detach_route_list_documents($route_list_id){
			//save detached docs id and numbers
			$detached_docs_data = DB::table('document_route_list')
							->join('documents', 'document_route_list.document_id', '=', 'documents.id')
							->where('document_route_list.route_list_id', $route_list_id)
							->select('documents.id', 'documents.document_number')
							->get();

							
							
			//detached documents from current route list
			DB::table('document_route_list')
				->where('route_list_id', $route_list_id)
				->delete();

			//check for doc number is repeated		
			foreach( $detached_docs_data as $ddd){
				//join document_route_list and documents
				$count_repeated = DB::table('document_route_list')
							->join('documents', 'document_route_list.document_id', '=', 'documents.id')
							->where('documents.document_number', $ddd->document_number)
							->count();
				//count records where document_number == $ddd->document_number
				if( $count_repeated == 1 ){
					DB::table('document_route_list')
						->join('documents', 'document_route_list.document_id', '=', 'documents.id')
						->where('documents.document_number', $ddd->document_number)
						->update(['document_route_list.is_repeated' => 0]);
				} elseif( $count_repeated > 1 ){
					DB::table('document_route_list')
						->join('documents', 'document_route_list.document_id', '=', 'documents.id')
						->where('documents.document_number', $ddd->document_number)
						->update(['document_route_list.is_repeated' => 1]);
				}				
			}
	}

	static public function add_document_to_route_list($doc_id, $route_list_id){

		$check = Document::check_if_repeated_document($doc_id);
//dd($check);
		if( $check ){
			DB::table('document_route_list')
				->insert(['document_id' => $doc_id,
							'route_list_id' => $route_list_id,
							'is_repeated' => 1]);
		}

		if( !$check ){
			DB::table('document_route_list')
				->insert(['document_id' => $doc_id,
							'route_list_id' => $route_list_id]);
		}

		return true;

	}

	public static function attach_documents_to_route_list($docs, $route_list_id)
	{
		foreach ($docs as $doc) {
			DB::table('documents')->where('id', $doc)
				->update(['route_list_id' => (int)$route_list_id]);
		}

		return true;
	}

	public static function detach_documents_from_route_list($docs)
	{
		foreach ($docs as $doc) {
			DB::table('documents')->where('id', $doc)
				->update(['route_list_id' => null]);
		}

		return true;
	}
}
