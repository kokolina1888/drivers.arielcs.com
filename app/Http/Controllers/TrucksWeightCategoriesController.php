<?php

namespace App\Http\Controllers;

use App\Truck;
use Illuminate\Http\Request;
use App\TrucksWeightCategory;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\TruckWeightCategoryEditRequest;
use App\Http\Requests\TruckWeightCategoryCreateRequest;

class TrucksWeightCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trucks_weight_categories = TrucksWeightCategory::all();

        return view('trucks_weight_categories.trucks_weight_categories_list', compact('trucks_weight_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trucks_weight_categories.trucks_weight_category_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TruckWeightCategoryCreateRequest $request)
    {
        try{           
        // dd($request->name);
        TrucksWeightCategory::create( ['name' => mb_strtoupper($request->name), 'payment' => $request->payment] );

        Session::flash('success', "Добавихте нов тонажна категория!");

        return redirect()->route('trucks_weight_categories_list');

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
        $trucks_weight_category = TrucksWeightCategory::findOrFail($id);
        $check_trucks = Truck::where('trucks_weight_category_id', $id)->first();
       
            if( $check_trucks ){
                return redirect()->route('trucks_weight_categories_list')->with('error', 'Категорията участва в данни за камион/и и не може да бъде променяна!');                
            }
        return view('trucks_weight_categories.trucks_weight_category_edit', compact('trucks_weight_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TruckWeightCategoryEditRequest $request, $id)
    {
         try {         

        $trucks_weight_category = TrucksWeightCategory::findOrFail($id);

        $check_trucks = Truck::where('trucks_weight_category_id', $id)->first();
       
            if( $check_trucks ){
                return redirect()->route('trucks_weight_categories_list')->with('error', 'Категорията участва в данни за камион/и и не може да бъде променяна!');                
            }


        $trucks_weight_category->update( ['name' => mb_strtoupper($request->name), 'payment' => $request->payment] );

        Session::flash('success', "Променихте тонажна категория!");

        return redirect()->route('trucks_weight_categories_list');

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
                TrucksWeightCategory::destroy($id);
                Session::flash('success', "Изтрихте тонажна категория!");
        
                return redirect()->route('trucks_weight_categories_list');
        } catch(\Exception $exception){
            if( $exception->errorInfo[0] == 23000){
                return back()->with('error','Не може да изтриете тонажна категория! Участва в свързани данни!');
            }
            return $exception->getMessage();
        }
    }
}
