<?php

namespace App\Http\Controllers;

use File;
use App\SalesData;
use App\Document;
use Carbon\Carbon;
use App\DocumentReader;
use Illuminate\Http\Request;

class SalesDataController extends Controller
{
    public function index()
    {
    	return view('sales_data.upload_sales_data');
    }

    public function bulk_save_sales_data(Request $request)
    {
    	try{
        
         	$data_to_store = DocumentReader::upload_info_file($request, 'document');
         
          	$res = SalesData::bulk_read_sales_data($data_to_store);    
        

      		// return redirect()->route('files_sales_data_list')
      		return redirect()->back()
      						->with('success', "Добавихте успешно файл с данни за {$res} товарителници!");         

      } catch(\Exception $exception) {
          
            // return back()->withInput()
                        // ->with('message','Невалидни данни! Опитайте отново!');
        return $exception->getMessage();
      }
    }    

    public function sales_data_file_list( $order='id', $direction = 'DESC' )
    {
      $sorted = $order;
      //for init
      $first_sales_data = SalesData::orderBy('id', 'ASC')->first();
      if( isset($first_sales_data) ){
        $createdAt = Carbon::parse($first_sales_data->created_at);
        $init_from_date = $createdAt->format('d/m/Y');
        $init_to_date   = date('d/m/Y');
        $init_date_range = $init_from_date . ' - ' . $init_to_date;
      } else {
        $init_date_range = '';
      }
      //init end

      $sales_datas = new SalesData;
      $sales_datas = $sales_datas->newQuery();

      if (request()->has('filename')) {
        $filters['filename'] = request('filename');
        $sales_datas->where('filename', 'LIKE', '%' . request('filename') . '%');
      }


    //transform date to date + hours-min in mysql format
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
          $sales_datas->where('created_at', '>=', $range_from)
          ->where('created_at', '<=', $range_to);
        
      }
      
      $sales_datas = $sales_datas->orderBy($order, $direction);
      $per_page = 10;
      $sales_datas = $sales_datas->paginate($per_page)
                    ->appends([
                      'filename'  => request('filename'), 
                      'date'      => request('date'), 
                      'order'     => $order, 
                      'direction' => $direction, ]
                    );

      if ($direction == 'DESC') {
        $arrow_class = 'fas fa-angle-down';
      }

      if($direction == 'ASC'){
        $arrow_class = 'fas fa-angle-up';
      }
     
      return view('sales_data.file_list', compact('sales_datas', 'arrow_class', 'sorted', 'per_page', 'filters', 'init_date_range', 'direction'));
    }

    public function sales_data_destroy($id)
    {
     
      $sales_data = SalesData::findOrFail($id);
      $filename = $sales_data->filename;
      $path = public_path() . '//temp/' . $filename;

      //check if deletion possible
      $check_docs = SalesData::check_file_attached_documents($id);
      
      if( $check_docs ){
        return redirect()->route('sales_data_file_list',  ['order' => request('sorted'), 
                                                          'direction' => request('direction'),
                                                          'filename' => request('filename'),
                                                          'page' => request('page'),
                                                          'date' => request('delete_date')
                                                        ])
                  ->with('warning', "Не може да изтриете файла - {$filename}! Документите в него са прикачени към пътни листове!"); 
      } else { 

        File::delete($path);
        $sales_data->documents()->delete();
        $sales_data->delete();     
          
        return redirect()->route('sales_data_file_list', ['order' => request('sorted'), 
                                                          'direction' => request('direction'),
                                                          'filename' => request('filename'),
                                                          'page' => request('page'),
                                                          'date' => request('delete_date')
                                                        ])
          ->with('success', "Изтрихте файл справка продажби - {$filename}!");
      }

     
    }
}
