@extends('layouts.master')
@section('title', 'Водачи - редактирай')


@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">РЕДАКТИРАЙ ДАННИ</h4> 
                <p><i>Данните въведени от товарителница/файл/ не подлежат на редактиране. <span class="text-success">Оцветени са в зелено.</span></i></p>               
            </div>
            <div class="card-body collapse in">
                <div class="card-block">                        
                    <form class="form form-horizontal row-separator" action="{{ route('documents_update', $document->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-body">                            
                            <div class="form-group row"> 
                                <div class="col-md-6">                               
                                    <label for="order_number" class="col-md-2 control-label">Заповед No</label>
                                    <div class="col-md-10">
                                        <input type="text" id="order_number" class="form-control" placeholder="Заповед No ..." name="order_number" value="{{ $document->order_number}}">
                                        @if($errors->has('order_number'))
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            {{ $errors->first('order_number') }} 
                                        </div>
                                        @endif 
                                    </div>                                 
                                </div>                                
                                <div class="col-md-6">                               
                                    <label class="col-md-2 control-labe text-success">Дата:</label>                                    
                                      {{$document->date_created }}   
                                </div>
                            </div>                          
                            <div class="form-group row"> 
                                <div class="col-md-6">
                                    <label for="route_list" class="col-md-2 control-label">Пътен лист</label>
                                    <div class="col-md-10">
                                        <input type="text" id="route_list" class="form-control" placeholder="Пътен лист ..." name="route_list" value="{{ $document->route_list}}">
                                        @if($errors->has('route_list'))
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            {{ $errors->first('route_list') }} 
                                        </div>
                                        @endif 
                                    </div>                                 
                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-2 control-label" for="truck">МПС</label>
                                    <div class="col-md-10">
                                        <select id="truck" name="truck" class="form-control">
                                            <option value="">-- изберете --</option>
                                            @foreach( $trucks as $t)
                                            <option value="{{ $t->id }}" <?php if($t->id == $document->truck->id){ echo 'selected'; } ?>>{{ $t->number }}</option>
                                            @endforeach                                                
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group row">
                                <div class="col-sm-4">                                
                                    <label for="km_start" class="col-md-4 control-label">Начален километраж</label>
                                    <div class="col-md-12">
                                    <input type="text" id="km_start" class="form-control" placeholder="Начален километраж ..." name="km_start" value="{{ $document->km_start}}">
                                    @if($errors->has('km_start'))
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        {{ $errors->first('km_start') }} 
                                    </div>
                                    @endif    
                                    </div>                              
                                </div>  
                                <div class="col-sm-4">                                
                                    <label for="km_end" class="col-md-4 control-label">Краен километраж</label>
                                    <div class="col-md-12">
                                        <input type="text" id="km_end" class="form-control" placeholder="Краен километраж ..." name="km_end" value="{{ $document->km_end}}">
                                        @if($errors->has('km_end'))
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            {{ $errors->first('km_end') }} 
                                        </div>
                                        @endif    
                                    </div>                              
                                </div>                                
                                <div class="col-sm-4">                                
                                    <label for="gas_quant" class="col-md-4 control-label">Заредено гориво</label>
                                    <div class="col-md-12">
                                        <input type="text" id="gas_quant" class="form-control" value="{{ $document->gas_quant}}" placeholder="Заредено гориво ..." name="gas_quant">
                                        @if($errors->has('gas_quant'))
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            {{ $errors->first('gas_quant') }} 
                                        </div>
                                        @endif    
                                    </div>                              
                                </div>
                            </div> 
                            <div class="form-group row">                             
                                <div class="col-sm-4">                                
                                    <label for="km_run" class="col-md-4 control-label">Изминати километри</label>
                                    <div class="col-md-12">
                                        <input type="text" id="km_run" class="form-control" value="{{ $document->km_run }}" placeholder="Изминати километри ..." name="km_run">
                                        @if($errors->has('km_run'))
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            {{ $errors->first('km_run') }} 
                                        </div>
                                        @endif    
                                    </div>                              
                                </div> 
                                <div class="col-sm-8"> 
                                    <label for="driver" class="col-md-1 control-label">Водач</label>
                                    <div class="col-md-12">
                                        <select id="driver" name="driver" class="form-control">
                                            <option value="">-- изберете --</option>
                                            @foreach( $drivers as $d)
                                            <option value="{{ $d->id }}" <?php if( $d->id == $document->driver->id ){ echo 'selected'; } ?>>{{ $d->name }}</option>
                                            @endforeach                                                
                                        </select>
                                    </div>
                                </div>
                            </div>                 
                            <div class="form-group row">                                
                                <div class="col-md-6">
                                    <!-- <div class="col-md-10"> -->
                                        <label class="control-label text-success">Товарителница: </label> {{ $document->document_number }}
                                    <!-- </div> -->
                                </div>                        
                            </div>
                            <div class="form-group row">                        
                                <div class="col-md-6">
                                    <label for="driver" class="col-md-6 control-label text-success">Товарителница - получател</label>
                                    <div class="col-md-12 border-right border-bottom">
                                        {{ $document->receiver }}
                                    </div>
                                </div>  
                                <div class="col-md-6">
                                    <label for="" class="col-md-5 control-label text-success">Населено място/Адрес</label>
                                    <div class="col-md-12 border-right border-bottom">
                                        {{ $document->receiver }}
                                    </div>
                                </div>                       
                            </div>
                            <div class="form-group row">                        
                                <div class="col-md-6">
                                    <label for="" class="col-md-6 control-label text-success">Товарителница - кг общо</label>
                                    <div class="col-md-12 border-right border-bottom">
                                        {{ $document->total_weight }}
                                    </div>
                                </div>  
                                <div class="col-md-6">
                                    <label for="driver" class="col-md-3 control-label text-success">Забележка</label>
                                    <div class="col-md-12 border-right border-bottom">
                                        {{ $document->note ?: 'няма забележка' }}
                                    </div>
                                </div>                       
                            </div>
                        </div> 

<!-- optional data -->
                        <div class="row form-group">
                            <div class="col-sm-4 bg-warning">   
                                <input class="form-check-input" type="checkbox" name="is_international" value="1" <?php if( $document->is_international == 1) { echo "checked"; } ?> id="is_international">
                                <label class="form-check-label" for="is_international">
                                    Международен
                                </label>               
                            </div>
                        </div>
                    <div class="form-actions">                                
                        <button type="submit" class="btn btn-primary">
                            <i class="far fa-save"></i> Запази
                        </button>
                    </div>
                </form>
            </div>               
        </div>
    </div>
</div>
</div>
@endsection