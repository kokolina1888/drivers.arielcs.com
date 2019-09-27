<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use App\Driver;
use App\Office;
use App\RouteList;
use Illuminate\Http\Request;
use App\Http\Requests\DriverEditRequest;
use App\Http\Requests\DriverCreateRequest;

class DriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::orderBy('status', 'DESC')
                    ->orderBy('office_id', 'ASC')
                    ->orderBy('type', 'ASC')
                    ->orderBy('name', 'ASC')->get();
        return view('drivers.drivers_list', ['drivers' => $drivers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $offices = Office::all();
        $offices =  $offices->pluck('name', 'id');
        return view('drivers.drivers_create', compact('offices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DriverCreateRequest $request)
    {
        try{
                      
            Driver::create( ['name' => mb_strtoupper($request->name), 'office_id' => $request->office, 'type' => $request->type ] );

            Session::flash('success', "Добавихте нов водач!");
            
            return redirect()->route('drivers_list');

        } catch(\Exception $exception) {

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
        $driver = Driver::findOrFail($id);
        $offices = Office::all();
        $offices =  $offices->pluck('name', 'id');

        $check_first_driver = RouteList::where('first_driver_id', $id)->first();
        if( $check_first_driver ){
            return redirect()->route('drivers_list')->with('error', 'Участва в пътен лист като първи шофьор и не може да бъде променян!');                
        }
        $check_scnd_driver = RouteList::where('second_driver_id', $id)->first();

        if( $check_scnd_driver ){
            return redirect()->route('drivers_list')->with('error', 'Участва в пътен лист като втори шофьор и не може да бъде променян!');                
        }
        return view('drivers.drivers_edit', ['driver' => $driver, 'offices' => $offices]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DriverEditRequest $request, $id)
    {
        try {

            $driver = Driver::find($id);
            $check_first_driver = RouteList::where('first_driver_id', $id)->first();
        if( $check_first_driver ){
            return redirect()->route('drivers_list')->with('error', 'Участва в пътен лист като първи шофьор и не може да бъде променян!');                
        }
        $check_scnd_driver = RouteList::where('second_driver_id', $id)->first();

        if( $check_scnd_driver ){
            return redirect()->route('drivers_list')->with('error', 'Участва в пътен лист като втори шофьор и не може да бъде променян!');                
        }

            $driver->update( ['name' => mb_strtoupper($request->name), 'office_id' => $request->office, 'type' => $request->type] );

            Session::flash('success', "Променихте водач!");
            
            return redirect()->route('drivers_list');

        } catch(\Exception $exception) {

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
        try{
               Driver::destroy($id);
               Session::flash('success', "Изтрихте водач!");
        
               return redirect()->route('drivers_list');
        } catch(\Exception $exception){
            if( $exception->errorInfo[0] == 23000){
                return back()->with('error','Не може да изтриете този шофьор! Участва в свързани данни!');
            }
            return $exception->getMessage();
        }

   }

   public function change_driver_status($id, $status)
   {

        $driver_status = Driver::change_driver_status($id, $status);
        $response['status'] = $driver_status;

        return response()->json($response);
   }
}
