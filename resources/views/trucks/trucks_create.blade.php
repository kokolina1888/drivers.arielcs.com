@extends('layouts.master')
@section('title', 'МПС - добави')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">ДОБАВИ МПС</h4>                
            </div>
            <div class="card-body collapse in">
                <div class="card-block">      
                    {!! Form::open(['route' => 'trucks_store']) !!} 
                        <div class="form-body">
                           <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="number">РЕГ. НОМЕР НА МПС</label>
                                    {!! Form::text('number', old('number'), ['id'=>"number", 'class'=>"form-control",' placeholder'=>"Рег. номер на МПС ..."]) !!}
                                    @if($errors->has('number'))
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        {{ $errors->first('number') }} 
                                    </div>
                                    @endif  
                                </div>
                                <div class="form-group">
                                    <label for="truck_load">Тонаж</label>
                                    {!! Form::text('truck_load', old('truck_load'), ['id'=>"truck_load", 'class'=>"form-control",' placeholder'=>"Тонаж ..."]) !!}
                                    @if($errors->has('truck_load'))
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        {{ $errors->first('truck_load') }} 
                                    </div>
                                    @endif  
                                </div>
                            </div>                                    
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">                            
                                <label for="trucks_weight_category">Тонажна категория</label>
                                {!! Form::select('trucks_weight_category', $trucks_weight_categories, old('trucks_weight_category'), ['placeholder' => '-- изберете --', 'id' => 'trucks_weight_category', 'class'=>'form-control']) !!}                               
                                @if($errors->has('trucks_weight_category'))
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        {{ $errors->first('trucks_weight_category') }} 
                                    </div>
                                @endif                              
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">                            
                                <label for="trucks_weight_category">Офис</label>
                                {!! Form::select('office', $offices, old('office'), ['id' => 'office', 'class'=>'form-control']) !!}     
                                @if($errors->has('office'))
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        {{ $errors->first('office') }} 
                                    </div>
                                @endif                            
                            </div>
                        </div>
                        <div class="form-actions">                                
                            <button type="submit" class="btn btn-primary">
                                <i class="far fa-save"></i> Запази
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>               
        </div>
    </div>
</div>
</div>
@endsection