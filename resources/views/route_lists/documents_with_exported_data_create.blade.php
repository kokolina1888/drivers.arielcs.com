@extends('layouts.master')
@section('title', 'Пътен лист - добави нов')


@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">ДОБАВЯНЕ НА ПЪТЕН ЛИСТ</h4>                
            </div>
            <div class="card-body collapse in">
                <div class="card-block">                        
                    <form class="form form-horizontal row-separator" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group row">                                
                                <label for="order_number" class="col-md-2 label-control text-right">Заповед No</label>
                                <div class="col-md-10">
                                    <input type="text" id="order_number" class="form-control" value="{{ old('') }}" placeholder="Заповед No ..." name="order_number">
                                    @if($errors->has('order_number'))
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        {{ $errors->first('order_number') }} 
                                    </div>
                                    @endif 
                                </div>                                 
                            </div>
                            <div class="form-group row">                                
                                <label for="route_list" class="col-md-2 label-control text-right">Пътен лист</label>
                                <div class="col-md-10">
                                    <input type="text" id="route_list" class="form-control" value="{{ old('') }}" placeholder="Пътен лист ..." name="route_list">
                                    @if($errors->has('route_list'))
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        {{ $errors->first('route_list') }} 
                                    </div>
                                    @endif 
                                </div>                                 
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 label-control text-right" for="truck">МПС</label>
                                <div class="col-md-10">
                                    <select id="truck" name="truck" class="form-control">
                                        <option value="" selected="" disabled="">-- изберете --</option>
                                        @foreach( $trucks as $t)
                                        <option value="{{ $t->id }}">{{ $t->number }}</option>
                                        @endforeach                                                
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">                                
                                    <label for="km_start" class="col-md-4 control-label">Начален километраж</label>
                                    <div class="col-md-12">
                                    <input type="text" id="km_start" class="form-control" value="{{ old('') }}" placeholder="Начален километраж ..." name="km_start">
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
                                        <input type="text" id="km_end" class="form-control" value="{{ old('') }}" placeholder="Краен километраж ..." name="km_end">
                                        @if($errors->has('km_end'))
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            {{ $errors->first('km_end') }} 
                                        </div>
                                        @endif    
                                    </div>                              
                                </div>
                            </div>     
                            <div class="form-group row">                             
                                <div class="col-sm-4">                                
                                    <label for="gas_quant" class="col-md-4 control-label">Заредено гориво</label>
                                    <div class="col-md-12">
                                        <input type="text" id="gas_quant" class="form-control" value="{{ old('gas_quant') }}" placeholder="Заредено гориво ..." name="gas_quant">
                                        @if($errors->has('gas_quant'))
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            {{ $errors->first('gas_quant') }} 
                                        </div>
                                        @endif    
                                    </div>                              
                                </div>                                                                                   
                                <div class="col-sm-4">                                
                                    <label for="km_run" class="col-md-6 control-label">Изминати километри</label>
                                    <div class="col-md-12">
                                        <input type="text" id="km_run" class="form-control" value="{{ old('km_run') }}" placeholder="Изминати километри ..." name="km_run">
                                            @if($errors->has('km_run'))
                                            <div class="col-sm-7 col-sm-offset-1 text-danger">
                                                {{ $errors->first('km_run') }} 
                                            </div>
                                            @endif    
                                        </div>                              
                                </div>
                            </div> 
                            <div class="form-group row">   
                                <div class="col-sm-6"> 
                                    <label for="driver1" class="col-md-2 control-label">Водач 1</label>
                                    <div class="col-md-12">
                                        <select id="driver1" name="driver1" class="form-control">
                                            <option value="" selected="" disabled="">-- изберете --</option>
                                            @foreach( $drivers as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach                                                
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6"> 
                                    <label for="driver2" class="col-md-2 control-label">Водач 2</label>
                                    <div class="col-md-12">
                                        <select id="driver2" name="driver2" class="form-control">
                                            <option value="" selected="" disabled="">-- изберете --</option>
                                            @foreach( $drivers as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach                                                
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <div class="input-file-container">  
                                        <input class="input-file" id="my-file" type="file" name="document">
                                        <label tabindex="0" for="my-file" class="input-file-trigger label-control text-right">Данни за товарителници - добавете файл 
                                            <i class="fas fa-upload"></i>
                                        </label>
                                    </div>
                                    <p class="file-return"></p>                    
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="col-sm-12" for="tov_start_row">
                                            Ред - начало
                                        </label>                            
                                        <div class="col-sm-12">                                                                
                                            <input type="text" id="tov_start_row" name="tov_start_row" class="form-control">                                              
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="col-sm-12" for="tov_start_end">
                                            Ред - край
                                        </label>                            
                                        <div class="col-sm-12">                                                                
                                            <input type="text" id="tov_start_end" name="tov_start_end" class="form-control">                                              
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- изберете режим на четене  -->
                            <!-- цял файл -->
                            <!-- ред от до  -->
                            <div class="row form-group"> 
                            <label class="col-sm-2" for="note"><i>Забележка</i></label>                            
                            <div class="col-sm-10">                                                                
                                <textarea id="note" name="note" cols="100">
                                </textarea>           
                            </div>
                        </div>
                        </div>
                    <!-- optional data -->
                        <div class="row form-group">                             
                            <div class="col-sm-12 bg-warning">                                                                
                                <input class="form-check-input" type="checkbox" <?php if(old('is_international') == 1) { echo "checked"; } ?> value="1" id="is_international">
                                <label class="form-check-label" for="is_international">
                                    Международен
                                </label>               
                            </div>
                        </div>
                        <div class="form-actions">                                
                            <button id="submit-form" type="submit" class="btn btn-primary">
                                <i class="far fa-save"></i> Запази
                            </button>
                        </div>
                    </form>
                </div>               
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  var token = "{{ Session::token() }}";   
  var host = "{{URL::to('/')}}";        
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': token
      }
  });
  
   document.querySelector("html").classList.add('js');

    var fileInput  = document.querySelector( ".input-file" ),  
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");
    
    button.addEventListener( "keydown", function( event ) {  
        if ( event.keyCode == 13 || event.keyCode == 32 ) {  
            fileInput.focus();  
        }  
    });
    button.addEventListener( "click", function( event ) {
       fileInput.focus();
       return false;
   });  
    fileInput.addEventListener( "change", function( event ) {  
        the_return.innerHTML = this.value;  
    });  
     
</script>
@endsection