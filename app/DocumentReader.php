<?php

namespace App;

use File;
use Excel;
use PHPExcel;
use PHPExcel_IOFactory;
// use PhpOffice\PHPExcel\IOFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\SampleReadFilter;


class DocumentReader extends Model
{


  public static function upload_info_file($request, $field)   
  {     
    // File::cleanDirectory('temp\\'); 

    $date= date("Y_m_d_H_i");   

// dd($date);
    $file = $request->file($field)->getClientOriginalName();
    $filename = pathinfo($file, PATHINFO_FILENAME);
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    $stored_filename = $filename .'_' . $date . '.' . $extension;
// dd($filename);
    $request->file($field)->move('temp', $stored_filename);

    $path = public_path() . '//temp/' . $stored_filename;

    $stored_file_id = SalesData::create(['filename' => $stored_filename])->id;
    // dd($stored_file_id);


    /**  Identify the type of $inputFileName  **/
    $inputFileType = PHPExcel_IOFactory::identify($path);
      // $spreadsheet = IOFactory::load($inputFileName);

    /**  Create a new Reader of the type that has been identified  **/
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);

    $objReader->setReadDataOnly(true);

    /**  Load $inputFileName to a PHPExcel Object  **/
    $objPHPExcel = $objReader->load($path);

    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
    
    $data['sheetdata'] = $sheetData;
    $data['sales_data_id'] = $stored_file_id;
    // dd($data['sales_data_id']);
    
    return $data;
  }

   public static function read_stored_file($path)   
  {     
    
    /**  Identify the type of $inputFileName  **/
    $inputFileType = PHPExcel_IOFactory::identify($path);
      // $spreadsheet = IOFactory::load($inputFileName);

    /**  Create a new Reader of the type that has been identified  **/
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);

    $objReader->setReadDataOnly(true);

    /**  Load $inputFileName to a PHPExcel Object  **/
    $objPHPExcel = $objReader->load($path);

    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
    // dd($sheetData);
      //dd($sheetData);
    return $sheetData;
  }

  

  static public function get_filtered_data($request, $field, $start_column, $end_column, $row)
  {

    File::cleanDirectory('temp\\');     

    $filename = $request->file($field)->getClientOriginalName();

    $request->file($field)->move('temp', $filename);

    $path = public_path().'//temp/'.$filename;


    /**  Identify the type of $inputFileName  **/
    $inputFileType = PHPExcel_IOFactory::identify($path);
      // $spreadsheet = IOFactory::load($inputFileName);

    /**  Create a new Reader of the type that has been identified  **/
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);


    $categories_filter = new SampleReadFilter($start_column, $end_column, $row, $row);

    $objReader->setReadFilter($categories_filter);

    /**  Load $inputFileName to a PHPExcel Object  **/
    $objPHPExcel = $objReader->load($path);
        // $sheetData = $objPHPExcel->getActiveSheet()->rangeToArray('F2:G2');
    $cells_range = $start_column."{$row}:".$end_column."{$row}";
    // dd($cells_range);
    // dd($cells_range);
    $sheetData = $objPHPExcel->getActiveSheet()->rangeToArray($cells_range);
    // dd($sheetData);
        // $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

    return $sheetData;        
  }

  // static public function get_filtered_data($request, $field, $start_column, $end_column, $row)
  // {

  //   File::cleanDirectory('temp\\');     

  //   $filename = $request->file($field)->getClientOriginalName();

  //   $request->file($field)->move('temp', $filename);

  //   $path = public_path().'//temp/'.$filename;


  //   /**  Identify the type of $inputFileName  **/
  //   $inputFileType = PHPExcel_IOFactory::identify($path);
  //     // $spreadsheet = IOFactory::load($inputFileName);

  //   /**  Create a new Reader of the type that has been identified  **/
  //   $objReader = PHPExcel_IOFactory::createReader($inputFileType);


  //   $categories_filter = new SampleReadFilter($start_column, $end_column, $row, $row);

  //   $objReader->setReadFilter($categories_filter);

  //   /**  Load $inputFileName to a PHPExcel Object  **/
  //   $objPHPExcel = $objReader->load($path);
  //       // $sheetData = $objPHPExcel->getActiveSheet()->rangeToArray('F2:G2');
  //   $cells_range = $start_column."{$row}:".$end_column."{$row}";
  //   // dd($cells_range);
  //   // dd($cells_range);
  //   $sheetData = $objPHPExcel->getActiveSheet()->rangeToArray($cells_range);
  //   // dd($sheetData);
  //       // $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

  //   return $sheetData;        
  // }
}
