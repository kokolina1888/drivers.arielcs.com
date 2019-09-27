<?php

namespace App\Http\Controllers;

use File;
use Excel;
use Session;
use Storage;
use PHPExcel;
use App\Truck;
use App\Driver;
use App\Document;
use App\RouteList;
use Carbon\Carbon;
use App\DocumentReader;
use PHPExcel_IOFactory;
use Illuminate\Http\Request;
use App\Http\Requests\HandDataEditRequest;
use App\Http\Requests\HandDataCreateRequest;
class DocumentsController extends Controller
{
    public function index( $order='id', $direction = 'DESC' )
    {   
      $sorted = $order;
      //for init
      $first_docs_data = Document::orderBy('date_created', 'ASC')->first();
      if( isset($first_docs_data) ){
        $createdAt = Carbon::parse($first_docs_data->date_created);      
        $init_from_date = $createdAt->format('d/m/Y');
        $init_to_date   = date('d/m/Y');
        $init_date_range = $init_from_date . ' - ' . $init_to_date;
      } else {
         $init_date_range = '';
      }
    // dd($init_date_range);
      //init end
      switch ($sorted) {
        case "id":
        $sorted = 'documents.id';
        break;
        case "on":
        $sorted = 'route_lists.order_number';
        break;
        case "dc":
        $sorted = 'documents.date_created';
        break;
        case "rl":
        $sorted = 'route_lists.route_list_number';
        break;
        case "dn":
        $sorted = 'documents.document_number';
        break;
        case "r":
        $sorted = 'documents.receiver';
        break; 
        case "ra":
        $sorted = 'documents.receiver_address';
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
              
              // dd($sorted);     
                    
                    // "tn">МПС<br>/РЕГ.НОМЕР/ <i class="{{ $arrow_class }}"></i></th>
                    // "fd">ВОДАЧ 1 <i class="{{ $arrow_class }}"></i></th>
                    // "sd">ВОДАЧ 2 <i class="{{ $arrow_class }}"></i></th>
                      
      $documents = new Document;
      $documents = $documents->newQuery();
      $documents = $documents->leftJoin('document_route_list', 'documents.id','=','document_route_list.document_id');
      $documents = $documents->leftJoin('route_lists', 'document_route_list.route_list_id','=','route_lists.id');
      $documents = $documents->leftJoin('trucks', 'route_lists.truck_id','=','trucks.id');
      $documents = $documents->leftJoin('drivers as first_d', 'route_lists.first_driver_id','=','first_d.id');
      $documents = $documents->leftJoin('drivers as second_d', 'route_lists.second_driver_id','=','second_d.id');
      $documents = $documents->select('documents.*', 'route_lists.order_number', 'route_lists.route_list_number', 'route_lists.km_start',
      'route_lists.km_end', 'route_lists.note', 'route_lists.gas_quant', 'route_lists.km_run', 'route_lists.is_international', 'first_d.name', 'second_d.name', 'trucks.number', 'document_route_list.is_repeated');
      // $documents = $documents->select('documents.*','route_lists.*', 'first_d.name', 'second_d.name', 'trucks.number');
      
      //filter by doc date created
      if( request()->has('date')){
        if( request('date') !== null){       
          $data_range = explode(' - ', request('date'));
          $from_date = explode('/', $data_range[0]);
          $to_date = explode('/', $data_range[1]);
           //convert to my-sql-date-string - 2019-06-30 14:41:33
          $range_from = $from_date[2].'-'.$from_date[1].'-'.$from_date[0].' 00:00:00';
          $range_to   = $to_date[2].'-'.$to_date[1].'-'.$to_date[0].' 23:59:59';
          
        }
          $filters['date'] = request('date');                
          $documents->where('documents.date_created', '>=', $range_from)
          ->where('documents.date_created', '<=', $range_to);        
      }
      //filter by truck
      if (request()->has('truck')) {
        if(request('truck') != null){          
          $filters['truck'] = request('truck');
          $documents = $documents->where('route_lists.truck_id', request('truck'));          
        }
      }
      //filter by first driver
      if (request()->has('first_driver')) {
        if(request('first_driver') != null){
          $filters['first_driver'] = request('first_driver');
          $documents = $documents->where('route_lists.first_driver_id', request('first_driver'));         
        }
      }

      //filter by second driver
      if (request()->has('second_driver')) {
        if(request('second_driver') != null){
          $filters['second_driver'] = request('second_driver');
          $documents = $documents->where('route_lists.second_driver_id', request('second_driver'));
        }
      }

       //filter by order number
      if (request()->has('order_number')) {
        if(request('order_number') != null){
          $filters['order_number'] = request('order_number');
          $documents = $documents->where('route_lists.order_number', 'LIKE', request('order_number').'%')->orWhere('route_lists.order_number2', 'LIKE', request('order_number').'%');
        }
      }

       //filter by document
      if (request()->has('document')) {
        if(request('document') != null){
          $filters['document'] = request('document');
          $documents->where('documents.document_number', 'LIKE', '%' . request('document') . '%');
        }
      }

      //filter by document receiver
      if (request()->has('receiver')) {
        if(request('receiver') != null){
          $filters['receiver'] = request('receiver');
          $documents->where('documents.receiver', 'LIKE', '%' . request('receiver') . '%');
        }
      }
      $documents = $documents->orderBy($sorted, $direction);
// dd($documents->orderBy($sorted, $direction)->paginate(20));
      //   // Get the results and return them.
      $per_page = 50;

      switch ($sorted) {
        case "documents.id":
        $sorted = 'id';
        break;
        case "route_lists.order_number":
        $sorted = 'on';
        break;
        case "documents.date_created":
        $sorted = 'dc';
        break;
        case "route_lists.route_list_number":
        $sorted = 'rl';
        break;
        case "documents.document_number":
        $sorted = 'dn';
        break;
        case "documents.receiver":
        $sorted = 'r';
        break; 
        case "documents.receiver_address":
        $sorted = 'ra';
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

      $documents = $documents->paginate($per_page)
      ->appends([
        'document'  => request('document'),
        'receiver'  => request('receiver'),
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
      
      return view('documents.documents_list', compact('documents', 'arrow_class', 'sorted', 'per_page', 'init_date_range', 'filters', 'trucks', 'drivers'));
    }

    public function index_data_hand_list( $order='id', $direction = 'DESC' )
  {        
    // dd(RouteList::all());
    //for init - only handentered data
    $first_route_list = RouteList::where('is_handentered', 1)
                        ->orderBy('created_at', 'ASC')->first();

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
// dd($sorted);
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
// dd($sorted);

    $route_lists = $route_lists->leftJoin('trucks', 'route_lists.truck_id','=','trucks.id');
    $route_lists = $route_lists->leftJoin('drivers as first_d', 'route_lists.first_driver_id','=','first_d.id');
    $route_lists = $route_lists->leftJoin('drivers as second_d', 'route_lists.second_driver_id','=','second_d.id');
    $route_lists = $route_lists->select('route_lists.*', 'trucks.number', 'first_d.name', 'second_d.name');

    $route_lists->where('is_handentered', 1);    
    // dd(request());

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
      
      return view('documents.handentered_data.data_hand_list', compact('route_lists', 'arrow_class', 'sorted', 'direction', 'per_page', 'filters', 'init_date_range', 'trucks', 'drivers'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $drivers = Driver::where('status', 1)
                    ->orderBy('name', 'ASC')
                    ->get();
      $trucks = Truck::all();
      return view('documents.documents_create', compact('drivers', 'trucks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try{
        $sheetdata = DocumentReader::upload_info_file($request, 'document');
        //from document
        $date = $sheetdata[9]['V'];
        $timestamp = strtotime($date);
        $mysql_date= date("Y-m-d", $timestamp);       
        $document = $sheetdata[8]['V'];
        $receiver = $sheetdata[12]['E'];
        $receiver_address = $sheetdata[14]['B'];
        $receiver_address = str_replace('Адрес:', '', $receiver_address);
        $receiver_address = str_replace(' ', '', $receiver_address);
        $sender = $sheetdata[5]['E'];
        //total weight in document
        $count_rows = count($sheetdata);
        $total_weight = 0;
        for( $i = 21; $i <= $count_rows; $i++ ){
          if( !empty($sheetdata[$i]['W']) ){
            $total_weight += $sheetdata[$i]['W'];
          }
        }

        //foreign transport??
        //note ?? from document
        Document::create( [
          'order_number' => $request->order_number,
          'date_created'  => $mysql_date,
          'route_list'    => $request->route_list,
          'document_number' => $document,
          'driver_id'     => $request->driver,
          'km_start'      => $request->km_start,
          'km_end'        => $request->km_end,   
          'truck_id'      => $request->truck,
          'total_weight'  => $total_weight,
          'sender'        => $sender,
          'receiver'      => $receiver,
          'receiver_address'=> $receiver_address,
          'note'          => '? note from document ???',
          'km_run'        => $request->km_run,
          'gas_quant'     => $request->gas_quant,
        ]);

        Session::flash('success', "Добавихте нов документ!");

        return redirect()->route('documents_list', ['order'=>'id', 'direction' => 'DESC']);

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //set in session
      session([
        'document'  => request('document'), 
        'date'      => request('date'), 
        'truck'     => request('truck'),
        'driver'    => request('driver'),
      ]);

      $trucks = Truck::all();
      $drivers = Driver::where('status', 1)
                ->orderBy('name', 'ASC')
                ->get();
      $document = Document::findOrFail($id);
      return view('documents.documents_edit', compact('document', 'trucks', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      try{

        $document = Document::find($id);
        // dd($request->is_international);

        // dd($request->order_number);
        $document->update( 
          [
            'order_number' => $request->order_number,
            'route_list'    => $request->route_list,              
            'driver_id'     => $request->driver,
            'km_start'      => $request->km_start,
            'km_end'        => $request->km_end,   
            'truck_id'      => $request->truck,
            'km_run'        => $request->km_run,
            'gas_quant'     => $request->gas_quant,
            'is_international' => $request->is_international,
          ]
          );        


        Session::flash('success', "Обновихте данните в документа!");            
        //retrieve from session filters if any, pass as parameters
        // $value = session('key');
        $document  = session('document'); 
        $date      = session('date'); 
        $truck     = session('truck');
        $driver    = session('driver');
        //unset from session info for filters
        $request->session()->forget(['document', 'date', 'truck', 'driver']);
        return redirect()->route('documents_list', ['order'=>'id',
          'direction' => 'DESC', 
          'document'  => $document, 
          'date'      => $date, 
          'truck'     => $truck,
          'driver'    => $driver,]);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Document::destroy($id);
      Session::flash('success', "Изтрихте документ!");

      $document  = request('document'); 
      $date      = request('hidden_date'); 
      $truck     = request('truck');
      $driver    = request('driver');        

      return redirect()->route('documents_list', [
        'order'=>'id',
        'direction' => 'DESC', 
        'document'  => $document, 
        'date'      => $date, 
        'truck'     => $truck,
        'driver'    => $driver]);

    }

    public function destroy_handentered_data($id)
    {
      $route_list = RouteList::findOrFail($id);       
      //remove data from pivot table and
      //renew is repeated data
      RouteList::detach_route_list_documents($id);

      $route_list->documents()->delete();
      $route_list->delete(); 
      //REMOVE FROM ORDERS TABLE!
      Driver::remove_orders_from_route_list($id);     

      return redirect()->back()->with(['order' => request('sorted'), 
                                      'direction' => request('direction'), 
                                      'first_driver' => request('first_driver'), 
                                      'second_driver' => request('second_driver'), 
                                      'truck' => request('truck'), 
                                      'order_number' => request('order_number'),
                                      'page' => request('page'),
                                      'date' => request('delete_date')
                                      ]);
      
    }

    public function create_data_by_hand()
    {
      $trucks = Truck::where('status', 1)
                ->orderBy('number', 'ASC')
                ->get();
      $drivers = Driver::where('status', 1)
                ->orderBy('name', 'ASC')
                ->get();
      return view('documents.handentered_data.data_create', compact('trucks', 'drivers'));
    }

    public function store_handentered_data(HandDataCreateRequest $request)
    {
      try{
        // dd($request->is_international);
        $is_international = 0;
        if( isset($request->is_international) ){
          $is_international = $request->is_international;
        }
        $route_list_id = RouteList::create( [
              'order_number'  => $request->order_number,
              'order_number2'   => $request->order_number2,
              'route_list_number' => $request->route_list,
              'first_driver_id'   => $request->driver1,
              'second_driver_id'  => $request->driver2,
              'km_start'      => $request->km_start,
              'km_end'        => $request->km_end,   
              'truck_id'      => (int)$request->truck,
              'note'          => $request->note,
              'km_run'        => (int)$request->km_run,
              'gas_quant'     => (int)$request->gas_quant,
              'note'      => $request->note,
              'is_international'  => (int)$request->is_international,
              "is_handentered"    => $request->is_handentered,         

          ])->id;

       $doc_id = Document::create([
        'route_list_id'     => $route_list_id,
        "date_created"      => $request->date, 
        "document_number"   => $request->document, 
        "receiver"          => $request->doc_receiver, 
        "receiver_address"  => $request->doc_receiver_address, 
        'total_weight'      => $request->total_weight,         
        'sender'            => $request->sender,       
      ])->id;

       // $route_list = RouteList::find($route_list_id)->documents()->attach($doc_id);
       $result = RouteList::add_document_to_route_list($doc_id, $route_list_id); 

      if( !empty($request->order_number) ){
        Driver::add_order_to_driver($route_list_id, $request->order_number, $request->driver1, 1);
      }

      if( !empty($request->order_number2) && !empty($request->driver2)){
        Driver::add_order_to_driver($route_list_id, $request->order_number2, $request->driver2, 2);
      }

       Session::flash('success', "Добавихте нови данни!");
       //redirect to handentered documents list

       return redirect()->route('data_hand_list', ['order'=>'id', 'direction' => 'DESC']);

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

  public function edit_handentered_data($id)
  { 
    session([
            'order' => request('sorted'), 
            'direction' => request('direction'), 
            'filter_date' => request('edit_date'), 
            'filter_first_driver' => request('first_driver'), 
            'filter_second_driver' => request('second_driver'), 
            'filter_truck' => request('truck'), 
            'filter_order_number' => request('order_number'), 
            'page' => request('page'),
            'path_to_return' => request('path'),  ]);

   $trucks = Truck::where('status', 1)
              ->orderBy('number', 'ASC')
              ->get();
   $drivers = Driver::where('status', 1)
              ->orderBy('name', 'ASC')
              ->get();
   $route_list = RouteList::with('documents')->findOrFail($id);

   return view('documents.handentered_data.data_edit', compact('route_list', 'trucks', 'drivers'));

 }

 public function update_handentered_data(HandDataEditRequest $request, $id)
 {
  try{

        $route_list = RouteList::with('documents')->find($id);

        $is_international = 0;

        if( isset($request->is_international) ){
          $is_international = $request->is_international;
        }
        
        $route_list->order_number     = $request->order_number;
        $route_list->order_number2    = $request->order_number2;
        $route_list->route_list_number = $request->route_list;
        $route_list->first_driver_id   = $request->driver1;
        $route_list->second_driver_id  = $request->driver2;
        $route_list->km_start      = $request->km_start;
        $route_list->km_end        = $request->km_end;   
        $route_list->truck_id      = (int)$request->truck;
        $route_list->note          = $request->note;
        $route_list->km_run        = (int)$request->km_run;
        $route_list->gas_quant     = (int)$request->gas_quant;
        $route_list->note          = $request->note;
        $route_list->is_international  = (int)$request->is_international;
        $route_list->is_handentered    = $request->is_handentered;
        
        $route_list->save();

        $document = $route_list->documents[0];
        // dd($document);
        RouteList::detach_route_list_documents($id);

        $document->update([
          "route_list_id"     => $route_list->id,
          "date_created"      => $request->date, 
          "document_number"   => $request->document, 
          "receiver"          => $request->doc_receiver, 
          "receiver_address"  => $request->doc_receiver_address, 
          'total_weight'      => $request->total_weight,         
          'sender'            => $request->sender,     
        ]);

        // $route_list = RouteList::find($id)->documents()->sync($document->id);

        

        Driver::remove_orders_from_route_list($id);

        $result = RouteList::add_document_to_route_list($document->id, $id); 


        if( !empty($request->order_number) ){
          Driver::add_order_to_driver($id, $request->order_number, $request->driver1, 1);
        }

        if( !empty($request->order_number2) && !empty($request->driver2)){
          Driver::add_order_to_driver($id, $request->order_number2, $request->driver2, 2);
        }

        
        Session::flash('success', "Обновихте данните в документа!");            
     
        $order        = session('order'); 
        $direction    = session('direction'); 
        $page                 = session('page');

        $path_to_return = session('path_to_return');
        
        $date = session('filter_date'); 
        $first_driver = session('filter_first_driver'); 
        $second_driver = session('filter_second_driver');        
        $truck = session('filter_truck'); 
        $order_number = session('filter_order_number');
      
        //unset from session info for filters
        $request->session()->forget(['order', 
                                      'direction', 
                                      'filter_date', 
                                      'filter_first_driver', 
                                      'filter_second_driver', 
                                      'filter_truck', 
                                      'filter_order_number', 
                                      'page',
                                      'path_to_return', ]);

        return redirect()->route($path_to_return, compact('order', 'direction', 'page', 'date', 'first_driver', 'second_driver', 'truck', 'order_number'));

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

  public function multi_files_store(Request $request)
    {

      $saved_files = [];
      // dd($saved_files);
      foreach ($request->files as $file) {
       
        File::cleanDirectory('temp\\'); 
        $filename = $file->getClientOriginalName();
        $file->move('temp', $filename);
        $path = public_path().'/temp/'.$filename;
        /**  Identify the type of $inputFileName  **/
        $inputFileType = PHPExcel_IOFactory::identify($path);
        /**  Create a new Reader of the type that has been identified  **/
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        $objReader->setReadDataOnly(true);

        /**  Load $inputFileName to a PHPExcel Object  **/
        $objPHPExcel = $objReader->load($path);

        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
      
        $doc_num = $sheetData[8]['V'];
        
        $target = $path;      
        $destination = str_replace('temp/', 'files/tov_'.$doc_num . '_', $path);
     // dd($destination);
     
        File::move( $target, $destination );  

        array_push($saved_files, 'tov_'.$doc_num . '_' . $filename);

      }
      
      $saved_files = array_unique($saved_files);
      
      sort($saved_files);

      $response['file_names'] = $saved_files;

      return response()->json($response);
     
    }

    public function remove_file(Request $request)
    {
      $file_to_remove = $request->file_to_remove;
      $target = public_path('files/' . $file_to_remove);
      File::delete($target);
      $response['success'] = 'Изтрихте файл!';

      return response()->json($response);
    }


    public function get_documents_to_append()
    {
      $search = request('search_str');
      $result = Document::get_documents_to_append($search);
      $response['documents'] = $result;
      return response()->json($response);
    }
}
