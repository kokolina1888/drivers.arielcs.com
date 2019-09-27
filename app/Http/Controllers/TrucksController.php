<?php

namespace App\Http\Controllers;

use Session;
use App\Truck;
use Validator;
use App\Office;
use App\RouteList;
use Illuminate\Http\Request;
use App\TrucksWeightCategory;
use App\Http\Requests\TruckEditRequest;
use App\Http\Requests\TruckCreateRequest;

class TrucksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trucks = Truck::with('office')->orderBy('status', 'DESC')->orderBy('office_id')->orderBy('number')->get();
        return view('trucks.trucks_list', ['trucks' => $trucks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trucks_weight_categories = TrucksWeightCategory::all();
        $trucks_weight_categories = $trucks_weight_categories->pluck('name', 'id');

        $offices = Office::all()->pluck('name', 'id');
        return view('trucks.trucks_create', compact('trucks_weight_categories', 'offices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TruckCreateRequest $request)
    {
        try{           

        Truck::create( ['number' => mb_strtoupper($request->number), 
                        'truck_load' => $request->truck_load,
                        'trucks_weight_category_id' => $request->trucks_weight_category, 
                        'office_id' => $request->office ] );

        Session::flash('success', "Добавихте нов автомобил!");

        return redirect()->route('trucks_list');

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
        $truck = Truck::findOrFail($id);
        $check_trucks = RouteList::where('truck_id', $id)->first();
        if( $check_trucks ){
            return redirect()->route('trucks_list')->with('error', 'Участва в пътен лист и не може да бъде променян!');                
        }
        $trucks_weight_categories = TrucksWeightCategory::all();
        $trucks_weight_categories = $trucks_weight_categories->pluck('name', 'id');
        
        $offices = Office::all()->pluck('name', 'id');
        return view('trucks.trucks_edit', ['truck' => $truck, 'trucks_weight_categories' => $trucks_weight_categories, 'offices' => $offices]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TruckEditRequest $request, $id)
    {
        try {         

        $truck = Truck::find($id);
        $check_trucks = RouteList::where('truck_id', $id)->first();
        if( $check_trucks ){
            return redirect()->route('trucks_list')->with('error', 'Участва в пътен лист и не може да бъде променян!');                
        }

        $truck->update( ['number' => mb_strtoupper($request->number), 
                        'truck_load' => $request->truck_load, 
                        'trucks_weight_category_id' => $request->trucks_weight_category,
                        'office_id' => $request->office ] );

        Session::flash('success', "Променихте автомобил!");

        return redirect()->route('trucks_list');

    } catch(\Exception $exception) {        
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
        try{
            Truck::destroy($id);
            Session::flash('success', "Изтрихте автомобил!");
    
            return redirect()->route('trucks_list');
        } catch(\Exception $exception){
            if( $exception->errorInfo[0] == 23000){
                return back()->with('error','Не може да изтриете този камион! Участва в свързани данни!');
            }
            return $exception->getMessage();
        }
    }

    public function change_truck_status($id, $status)
   {

        $truck_status = Truck::change_truck_status($id, $status);
        $response['status'] = $truck_status;

        return response()->json($response);
   }
}
