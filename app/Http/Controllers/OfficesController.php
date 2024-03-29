<?php

namespace App\Http\Controllers;

use App\Truck;
use App\Driver;
use App\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\OfficeEditRequest;
use App\Http\Requests\OfficeCreateRequest;

class OfficesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = Office::all();
        return view('offices.offices_list', ['offices' => $offices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offices.offices_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficeCreateRequest $request)
    {
        try{
                      
            Office::create( ['name' => mb_strtoupper($request->name), 'is_sofia' => $request->is_sofia] );

            Session::flash('success', "Добавихте нов офис!");
            
            return redirect()->route('offices_list');

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
        $office = Office::findOrFail($id);
         $check_drivers = Driver::where('office_id', $id)->first();
         
            if( $check_drivers ){
                return redirect()->back()->with('error', 'Офисът участва в данни за шофьор/и и не може да бъде променян!');
            }
            $check_trucks = Truck::where('office_id', $id)->first();
            if( $check_trucks ){
                return redirect()->back()->with('error', 'Офисът участва в данни за камион/и и не може да бъде променян!');                
            }
        return view('offices.offices_edit', ['office' => $office]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfficeEditRequest $request, $id)
    {
        try {

            $office = Office::find($id);
            if( $check_drivers ){
                return redirect()->back()->with('error', 'Офисът участва в данни за шофьор/и и не може да бъде променян!');
            }
            $check_trucks = Truck::where('office_id', $id)->first();
            if( $check_trucks ){
                return redirect()->back()->with('error', 'Офисът участва в данни за камион/и и не може да бъде променян!');                
            }

            $office->update( ['name' => mb_strtoupper($request->name), 'is_sofia' => $request->is_sofia] );

            Session::flash('success', "Променихте водач!");
            
            return redirect()->route('offices_list');

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
        try {
            Office::destroy($id);
            Session::flash('success', "Изтрихте офис!");
    
            return redirect()->route('offices_list');
        } catch(\Exception $exception) {

            if( $exception->errorInfo[0] == 23000){
                return back()->with('error','Не може да изтриете този офис! Участва в свързани данни!');
            }
            return $exception->getMessage();
        }
    }
}
