<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SalesData extends Model
{
  protected $fillable = ['filename'];

  public function documents()
  {
    return $this->hasMany('App\Document');
  }
    static public function bulk_read_sales_data($data)
    {
    	// "A" => "Документ №"
            // "B" => "Дата"    
            // "F" => "Партньор"
            // "G" => "Обект"  => I  
             // "I" => "Мярка" => K
             // "J" => "Мярка 2" => L
             // "K" => "Количество" => N
             // "L" => "Коефициент/;мин кол-во" => M
            //adress/grad => H

    	$belongs_to_file_id = $data['sales_data_id'];

    	$collection = collect($data['sheetdata']);

    	$sorted = $collection->sortBy('A');
    	$sorted->values()->all();
    	$sorted_data = $sorted->toArray();
    	// dd($sorted_data);
  		//stores doc num
  		$doc_num = '';
  		//doc_total_weight
  		$doc_total_weight = 0;
  		$doc_rows = count($sorted_data);  
      // dd($doc_rows);
  		$tov_num = 0;	

  		for($i = 0; $i <= $doc_rows; $i++){
  			//check if current data array is valid data array - J not NULL, K is number
        //J changed to L, K to N
  			if( !empty($sorted_data[$i]['L'])  ){
       		if( is_numeric($sorted_data[$i]['M']) ){             
  					//starts with check if current doc num is equal to stored doc num
  					if($sorted_data[$i]['A'] != $doc_num){
  					//if false
  						//checks if doc_total_weight is 0 
  						if($doc_total_weight == 0){
  						// 
  						//if true - new doc begins
  						//step 1 - gets the first row of tovaritelnica
    						//stores doc num
    						$doc_num = $sorted_data[$i]['A'];
    						$tov_num++;
    						//stores doc date
    						$doc_date = $sorted_data[$i]['B'];
    						$timestamp = strtotime($doc_date);
        				$mysql_date= date("Y-m-d", $timestamp);   
    						//stores receiver
    						$doc_receiver = $sorted_data[$i]['F'];
    						//stores receiver address - changed
    						$doc_receiver_address = $sorted_data[$i]['H'];
    						//stores sender - changed
    						$doc_sender = $sorted_data[$i]['I'];
    						//transforms qtty to kg measure1*ratio
    						$doc_current_weight = $sorted_data[$i]['N']*$sorted_data[$i]['M'];
                // var_dump($doc_current_weight, $sorted_data[$i]['M'], $i);
    						//adds transformed to doc_total_weight
    						$doc_total_weight += $doc_current_weight;
     					  // var_dump($doc_total_weight);		

    					// 
  						} else {
  							// adds data in DB - stores tovaritelnica data
     					// var_dump($doc_total_weight);		

  							Document::create([
            					'date_created'    => $mysql_date,             
            				  	'document_number' => $doc_num,
            				  	'total_weight'    => $doc_total_weight,
            				  	'sender'          => $doc_sender,
            				  	'receiver'        => $doc_receiver,
            				  	'receiver_address'  => $doc_receiver_address,
            				  	'sales_data_id'			=> $belongs_to_file_id,
            				   ]
            				);
            				  // clears data - prepares for new doc and gets data for the new doc
            				  $doc_total_weight = 0;
            				  $doc_num = $sorted_data[$i]['A'];  
            				  $tov_num++;
            				  $doc_date = $sorted_data[$i]['B'];
    						      $timestamp = strtotime($doc_date);
        					    $mysql_date= date("Y-m-d", $timestamp);   
    						      //stores receiver
    						      $doc_receiver = $sorted_data[$i]['F'];
    						      //stores receiver address - changed
    						      $doc_receiver_address = $sorted_data[$i]['H'];
    						      //stores sender - changed
    						      $doc_sender = $sorted_data[$i]['I'];	
	            			  //transforms qtty to kg measure1*ratio
	    					      $doc_current_weight = $sorted_data[$i]['N']*$sorted_data[$i]['M'];
                      // var_dump($doc_current_weight, $sorted_data[$i]['M'], $i);
	    					      //adds transformed to doc_total_weight
	    					      $doc_total_weight += $doc_current_weight;
     					        // var_dump($doc_total_weight);		

			
	  					}//end if $doc_total_weight == 0
	
					} else {  
						// var_dump($sorted_data[$i]['A']);
						//if true same doc num - doc data continues	
  	  					//transforms qtty to kg measure1*ratio
     					$doc_current_weight = $sorted_data[$i]['N']*$sorted_data[$i]['M'];
              // var_dump($doc_current_weight, $sorted_data[$i]['M'], $i);
     					//adds transformed to doc_total_weight
     					$doc_total_weight += $doc_current_weight;   
     					// var_dump($doc_total_weight);		
   					}//end if row doc_num is equal to stored doc num
  				}  				
  			}
  		}//end for loop
  			// stored info after last file row
  			Document::create([            			
            			'date_created'    => $mysql_date,             
            		  'document_number' => $doc_num,
            		  'total_weight'    => $doc_total_weight,
            		  'sender'          => $doc_sender,
            		  'receiver'        => $doc_receiver,
            		  'receiver_address'=> $doc_receiver_address,
            			'sales_data_id'	   => $belongs_to_file_id,

            		   ]);
     					// var_dump($doc_total_weight);		

  			return $tov_num;
  	}  	

    static public function check_file_attached_documents($id)
    {

      return DB::table('documents')
            ->select('documents.id')
            ->join('document_route_list', 'documents.id', 'document_route_list.document_id')
            ->where('documents.sales_data_id', $id)            
            ->first();
            
    }
}

