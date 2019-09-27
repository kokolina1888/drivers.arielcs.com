@extends('layouts.master')
@section('title', 'Водачи - редактирай')


@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="fas fa-user-tie"></i> РЕДАКТИРАЙ ВОДАЧ</h4>                
            </div>
            <div class="card-body collapse in">
                <div class="card-block"> 
                    {!! Form::model($driver, ['route' => ['drivers_update', $driver->id]]) !!} 
                        <div class="form-body">
                           <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Име и фамилия</label>
                                    {!! Form::text('name', $driver->name, ['id'=>"name", 'class'=>"form-control",' placeholder'=>"Име и фамилия ..."]) !!}
                                    @if($errors->has('name'))
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        {{ $errors->first('name') }} 
                                    </div>
                                    @endif  
                                    </div>
                                </div>                                    
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">      
                                    <label for="office">Офис</label>   
                                    {!! Form::select('office', $offices, $driver->office_id, ['placeholder' => '-- изберете --', 'id' => 'office', 'class'=>'form-control']) !!}   
                                    @if($errors->has('office'))
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        {{ $errors->first('office') }} 
                                    </div>
                                    @endif                               
                                </div>
                            </div>
                            <div id="driver-type" class="form-group row @if( $driver->office_id != 1) hidden @endif">
                                <div class="col-md-6">                            
                                    <label for="office">Тип</label>
                                    {!! Form::select('type', ['1' => 'София - София', '2' => 'София - провинция'], $driver->type, ['placeholder' => '-- изберете --', 'id' => 'type', 'class'=>'form-control']) !!} 
                                    @if($errors->has('type'))
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            {{ $errors->first('type') }} 
                                        </div>
                                    @endif                                
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">                                
                            <button type="submit" class="btn btn-primary">
                                <i class="far fa-save"></i> Промени
                            </button>
                        </div>
                {!! Form::close() !!}
            </div>               
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $('#office').on('change', function(){
        if($(this).val() == 1){
            $('#driver-type').removeClass('hidden');
        } else {
            $('#driver-type').addClass('hidden');
        }
    });
</script>
@endsection