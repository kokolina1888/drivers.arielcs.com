<?php

namespace App\Http\Controllers;

use File;
use App\Truck;
use App\Driver;
use App\Document;
use App\RouteList;
use Carbon\Carbon;
use App\DocumentReader;
use Illuminate\Http\Request;
use App\Http\Requests\RouteListCreateRequest;
use App\Http\Requests\RouteListEditRequest;
use Illuminate\Support\Facades\Session;



class RouteListsController extends Controller
{
  public function index( $order='id', $direction = 'DESC' )
  {        
    //for init
    $first_route_list = RouteList::orderBy('created_at', 'ASC')->first();
    if( !empty($first_route_list) ){
      $createdAt = Carbon::parse($first_route_list->created_at);      
      $init_from_date = $createdAt->format('d/m/Y');
      $init_to_date   = date('d/m/Y');
      $init_date_range = $init_from_date . ' - ' . $init_to_date;    
    } else {
      $init_date_range = '';
    }
    //init end
    $sorted = $order;        
    $route_lists = new RouteList;
    $route_lists = $route_lists->newQuery();

    switch ($sorted) {
        case "id":
        $sorted = 'route_lists.id';
        break;
        case "on":
        $sorted = 'route_lists.order_number';
        break;
        case "rl":
        $sorted = 'route_lists.route_list_number';
        break; 
        case "tn":
        $sorted = 'trucks.number';
        break; 
        case "fd":
        $sorted = 'first_d.name';
        break; 
        case "sd":
        $sorted = 'second_d.name';
        break;     
      }

    $route_lists = $route_lists->leftJoin('trucks', 'route_lists.truck_id','=','trucks.id');
    $route_lists = $route_lists->leftJoin('drivers as first_d', 'route_lists.first_driver_id','=','first_d.id');
    $route_lists = $route_lists->leftJoin('drivers as second_d', 'route_lists.second_driver_id','=','second_d.id');
    $route_lists = $route_lists->select('route_lists.*', 'trucks.number', 'first_d.name', 'second_d.name');
    

    //filter by doc date created
    if( request()->has('date')){
      if( request('date') !== null){
      // dd(request('date'));
        $data_range = explode(' - ', request('date'));
        $from_date = explode('/', $data_range[0]);
        $to_date = explode('/', $data_range[1]);
        // dd($data_range);
        //convert to my-sql-date-string - 2019-06-30 14:41:33
        $range_from = $from_date[2].'-'.$from_date[1].'-'.$from_date[0].' 00:00:00';
        $range_to   = $to_date[2].'-'.$to_date[1].'-'.$to_date[0].' 23:59:59';
          
      }
        $filters['date'] = request('date');                
        $route_lists->where('route_lists.created_at', '>=', $range_from)
          ->where('route_lists.created_at', '<=', $range_to);        
    }

    //filter by truck
    if (request()->has('truck')) {
      if(request('truck') != null){
        $filters['truck'] = request('truck');
        $route_lists = $route_lists->where('route_lists.truck_id', request('truck'));       
      }
    }
    //filter by first driver
    if (request()->has('first_driver')) {
      if(request('first_driver') != null){
        $filters['first_driver'] = request('first_driver');
        $route_lists = $route_lists->where('route_lists.first_driver_id', request('first_driver'));
      }
    }

    //filter by first driver
    if (request()->has('second_driver')) {
      if(request('second_driver') != null){
        $filters['second_driver'] = request('second_driver');
        $route_lists = $route_lists->where('route_lists.second_driver_id', request('second_driver'));
      }
    }

    //filter by order number
    if (request()->has('order_number')) {
      if(request('order_number') != null){
        $filters['order_number'] = request('order_number');
        $route_lists = $route_lists->where('route_lists.order_number', 'LIKE', request('order_number').'%')
                        ->orWhere('route_lists.order_number2', 'LIKE', request('order_number').'%');
      }
    }

    $route_lists = $route_lists->orderBy($sorted, $direction);
    // Get the results and return them.
    $per_page = 20;

    switch ($sorted) {
        case "route_lists.id":
        $sorted = 'id';
        break;
        case "route_lists.order_number":
        $sorted = 'on';
        break;  
        case "route_lists.route_list_number":
        $sorted = 'rl';
        break;     
        case "trucks.number":
        $sorted = 'tn';
        break; 
        case "first_d.name":
        $sorted = 'fd';
        break; 
        case "second_d.name":
        $sorted = 'sd';
        break;     
      }
    
    $route_lists = $route_lists->paginate($per_page)
      ->appends([     
        'date'      => request('date'), 
        'truck'     => request('truck'),       
        'first_driver'     => request('first_driver'),       
        'second_driver'    => request('second_driver'),       
        'order_number'     => request('order_number'),       
        'order'     => $sorted, 
        'direction' => $direction ]
      );
      if ($direction == 'DESC') {
        $arrow_class = 'fas fa-angle-down';
      }

      if($direction == 'ASC'){
        $arrow_class = 'fas fa-angle-up';
      }
     //pass trucks for filter
      $trucks = Truck::orderBy('status', 'DESC')
                ->orderBy('number', 'ASC')
                ->get();
      $drivers = Driver::orderBy('status', 'DESC')
                ->orderBy('name', 'ASC')
                ->get();
      
      return view('route_lists.route_lists_list', compact('route_lists', 'arrow_class', 'sorted', 'direction', 'per_page', 'filters', 'init_date_range', 'trucks', 'drivers'));
    }
    
    public function route_list_store(RouteListCreateRequest $request)
    {
      try{
       // dd($request->order_number2);
    		$route_list_id = RouteList::create( [
              'order_number'  => $request->order_number,
          		'order_number2' 	=> $request->order_number2,
          		'route_list_number' => $request->route_list,
          		'first_driver_id'   => $request->driver1,
          		'second_driver_id'  => $request->driver2,
          		'km_start'      => $request->km_start,
          		'km_end'        => $request->km_end,   
          		'truck_id'      => (int)$request->truck,
          		'note'          => $request->note,
          		'km_run'        => (int)$request->km_run,
          		'gas_quant'     => (int)$request->gas_quant,
          		'note'			=> $request->note,
          		'is_international'	=> (int)$request->is_international
        	])->id;

        $route_list = RouteList::find($route_list_id);
    		
    		$documents = explode(',',$request->attached_documents);
        //filter documents by id
        $documents_ids = array_unique($documents);

         //filter documents by document number
        $documents = Document::get_distinct_numbers_ids($documents_ids);
        
        //check for already attached documents with the same number
        foreach( $documents as $doc_id ){
         $result = RouteList::add_document_to_route_list($doc_id, $route_list_id); 
        }

        if( !empty($request->order_number) ){
          Driver::add_order_to_driver($route_list_id, $request->order_number, $request->driver1, 1);
        }

        if( !empty($request->order_number2) && !empty($request->driver2)){
          Driver::add_order_to_driver($route_list_id, $request->order_number2, $request->driver2, 2);
        }

        Session::flash('success', 'Добавихте пътен лист!');
        $response = [];
        $response['success'] = 'Добавихте пътен лист!';
      	return response()->json($response);

      } catch(\Exception $exception) {

         // return back()->withInput()
                        // ->with('message','Невалидни данни! Опитайте отново!');
        return $exception->getMessage();
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function route_list_with_exported_data_add()
    {
      $drivers = Driver::where('status', 1)
                ->orderBy('name', 'ASC')
                ->get();
      $trucks = Truck::all();
      return view('route_lists.documents_with_exported_data_create', compact('drivers', 'trucks'));
    }   

    public function route_list_create()
    {
      $drivers = Driver::where('status', 1)
                ->orderBy('name', 'ASC')
                ->get();
      $trucks = Truck::where('status', 1)
                ->orderBy('number', 'ASC')
                ->get();
      return view('route_lists.documents_create', compact('drivers', 'trucks'));
    }

    public function destroy($id)
    {
      $route_list = RouteList::findOrFail($id); 
      
      //delete data from pivot table
      // $route_list->documents()->detach();  
      //remove data from pivot table and
      //renew is repeated data
      RouteList::detach_route_list_documents($id);    

      //renew is repeated data      
      $route_list->delete();
      
      //REMOVE FROM ORDERS TABLE!
      Driver::remove_orders_from_route_list($id);

      return redirect()->route('route_lists_list', ['order' => request('sorted'), 
                                                    'direction' => request('direction'), 
                                                    'first_driver' => request('first_driver'), 
                                                    'second_driver' => request('second_driver'), 
                                                    'truck' => request('truck'), 
                                                    'order_number' => request('order_number'), 
                                                    'page' => request('page'),
                                                    'date' => request('delete_date')
                                                    ]);
      
    }

    public function edit($id)
    {
      $route_list = RouteList::findOrFail($id);
      $trucks     = Truck::where('status', 1)
                  ->orderBy('number', 'ASC')
                  ->get();
      $drivers    = Driver::where('status', 1)
                  ->orderBy('name', 'ASC')
                  ->get();
      $documents  = $route_list->documents()->get();
      // dd($documents);     
      //filters, sort data, pagination
      $order = request('sorted'); 
      $direction = request('direction'); 
      $filter_date = request('edit'); 
      $filter_first_driver = request('first_driver'); 
      $filter_second_driver = request('second_driver'); 
      $filter_truck = request('truck'); 
      $filter_order_number = request('order_number'); 
      $page = request('page');     
                 
      //get route list associated docs
      return view('route_lists.documents_edit', compact('route_list', 'trucks', 'drivers', 'documents', 'order', 'direction', 'filter_date', 'filter_first_driver', 'filter_second_driver', 'filter_truck', 'filter_order_number', 'page'));
    }

    public function update(RouteListEditRequest $request, $id)
    {
      try{
       
        $route_list = RouteList::findOrFail($id);
       
        $route_list->order_number       = $request->order_number;
        $route_list->order_number2      = $request->order_number2;
        $route_list->route_list_number  = $request->route_list;
        $route_list->first_driver_id    = $request->driver1;
        $route_list->second_driver_id   = $request->driver2;
        $route_list->km_start       = $request->km_start;
        $route_list->km_end         = $request->km_end;
        $route_list->truck_id       = (int)$request->truck;
        $route_list->note           = $request->note;
        $route_list->km_run         = (int)$request->km_run;
        $route_list->gas_quant      = (int)$request->gas_quant;
        $route_list->note           = $request->note;
        $route_list->is_international  = (int)$request->is_international;
        $route_list->save();
    
        $documents = explode(',', $request->attached_documents);        
        
        //filter documents by id
        $documents_ids = array_unique($documents);

         //filter documents by document number
        $documents = Document::get_distinct_numbers_ids($documents_ids);

        //delete all records in document_route_lists and update is_repeated
        RouteList::detach_route_list_documents($id);
        //prceed as if store new route list - see store method
         //check for already attached documents with the same number
        foreach( $documents as $doc_id ){
         $result = RouteList::add_document_to_route_list($doc_id, $id); 
        }
    
        //delete from orders table if any order numbers for this route list exists
        Driver::remove_orders_from_route_list($id);

        if( !empty($request->order_number) ){
          Driver::add_order_to_driver($id, $request->order_number, $request->driver1, 1);
        }

        if( !empty($request->order_number2) && !empty($request->driver2)){
          Driver::add_order_to_driver($id, $request->order_number2, $request->driver2, 2);
        }
        
        Session::flash('success', "Променихте пътен лист!");
        //filters, sort data, pagination
       
        $response['order'] = request('order'); 
        $response['direction'] = request('direction'); 
        $response['date'] = request('filter_date'); 
        $response['filter_first_driver'] = request('filter_first_driver'); 
        $response['filter_second_driver'] = request('filter_second_driver'); 
        $response['filter_truck'] = request('filter_truck'); 
        $response['order_number'] = request('filter_order_number'); 
        $response['page'] = request('page');   
        
          // $response['success'] = "Променихте пътен лист No{$route_list->route_list_numbert} !";
        return response()->json($response);

      } catch(\Exception $exception) {
            // return back()->withInput()
                        // ->with('message','Невалидни данни! Опитайте отново!');
        return $exception->getMessage();
      }
    }
}
