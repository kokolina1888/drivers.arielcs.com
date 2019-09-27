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
                                        <option value="">-- изберете --</option>
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
                            </div> 
                            <div class="form-group row">                             
                                <div class="col-sm-4">                                
                                    <label for="km_run" class="col-md-4 control-label">Изминати километри</label>
                                    <div class="col-md-12">
                                        <input type="text" id="km_run" class="form-control" value="{{ old('km_run') }}" placeholder="Изминати километри ..." name="km_run">
                                        @if($errors->has('km_run'))
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            {{ $errors->first('km_run') }} 
                                        </div>
                                        @endif    
                                    </div>                              
                                </div> 
                                <div class="col-sm-8"> 
                                    <label for="driver1" class="col-md-2 control-label">Водач 1</label>
                                    <div class="col-md-12">
                                        <select id="driver1" name="driver1" class="form-control">
                                            <option value="">-- изберете --</option>
                                            @foreach( $drivers as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach                                                
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-8 col-sm-offset-4"> 
                                    <label for="driver2" class="col-md-2 control-label">Водач 2</label>
                                    <div class="col-md-12">
                                        <select id="driver2" name="driver2" class="form-control">
                                            <option value="">-- изберете --</option>
                                            @foreach( $drivers as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach                                                
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="input-file-container"> 
                                    <input id="myInput" type="file" multiple style="display:none" />
                                    <button id="myButton" type="button" style="border-radius: 5px; background-color: #fff; color: green;">+ Добави товарителници</button>
                                </div>
                                <div id="myFiles" class="row"></div>
                                <p class="file-return"></p>                    
                            </div> 
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
  $('#submit-form').on('click', function(e){
    e.preventDefault();
    var orderNumber = $("#order_number").val(),
        routeList   = $('#route_list').val(),
        truck       = $('#truck').val(),
        km_start    = $('#km_start').val(),
        km_end      = $('#km_end').val(),
        gas_quant   = $('#gas_quant').val(),
        km_run      = $('#km_run').val(),
        driver1     = $('#driver1').val(),
        driver2     = $('#driver2').val(),
        attachedFiles   = [],
        fileDivElements = $('#myFiles div'),
        note        = $('#note').val();

        // console.log($('#is_international').is(":checked"));
         
        fileDivElements.each(function(e) {          
          attachedFiles.push(fileDivElements[e].getAttribute('id'));
        });
          
        let data = new FormData();    
        data.append('order_number', orderNumber);
        data.append('route_list', routeList);
        data.append('truck', truck);
        data.append('km_start', km_start);
        data.append('km_end', km_end);
        data.append('gas_quant', gas_quant);
        data.append('km_run', km_run);
        data.append('driver1', driver1);
        data.append('driver2', driver2);
        data.append('attached_files', attachedFiles);
        data.append('note', note);
        if( $('#is_international').is(":checked") ){
             data.append('is_international', 1);
        } else {
            data.append('is_international', 0);
        }

        $.ajax({
          url:host+'/route-list-add',
          data: data,
          type: 'POST',
          success: function(data) { 
              //append success message@!
              location = host + '/documents-list/id/DESC';
          },
          error: function(data) { 
            //append error message and try again
           },
          cache: false,
          processData: false,
          contentType: false
        });    
    })

  var inputFile = $('#myInput');
  var buttonFiles = $('#myButton');
  // let buttonSubmit = $('#mySubmitButton');
  var filesContainer = $('#myFiles');
  var filesToList = [];

  inputFile.change(function() {
    let newFiles = []; 
    let files = [];
    for(let index = 0; index < inputFile[0].files.length; index++) {
      let file = inputFile[0].files[index];
      newFiles.push(file);
      files.push(file);
    }  

    let data = new FormData();
    for(var i = 0; i < files.length; i++){
        data.append('file'+i, files[i])
    }
     // filesContainer.empty();
    $.ajax({
      url:host+'/documents-multi-add',
      data: data,
      type: 'POST',
      success: function(response) { 
       
        var savedFiles = response.file_names;        
        for( var i = 0; i < savedFiles.length; i++){
          if( filesToList.indexOf(savedFiles[i]) == -1 ){
            filesToList.push(savedFiles[i]);
            let fileElement = $(`<div class=col-sm-4 id=${savedFiles[i]}><p style="border-bottom: 1px solid #ccc">${savedFiles[i]}<button data-filename=${savedFiles[i]} class="btn btn-danger btn-xs btn-file-remove" style="float:right"><i class="fa fa-minus-circle" aria-hidden="true"></i></button></p></div>`);
            filesContainer.append(fileElement);
          }
        }       
      },
      error: function(data) { //append error message and try again
       },
      cache: false,
      processData: false,
      contentType: false
    });
  });
  buttonFiles.click(function() {
      inputFile.click();
  });

  $('body').on('click', '.btn-file-remove', function(e){    
    e.preventDefault();
    var fileToRemove = $(this).data('filename');
    let data = new FormData();
    data.append('file_to_remove', fileToRemove);  
    
    $.ajax({
        url:host+'/document-remove',
        data: data,
        type: 'POST',
        success: function(data) { 
          $(e.target).closest("div").remove();
          let indToDelete = filesToList.indexOf(fileToRemove);
            filesToList.splice(indToDelete, 1);
        },
        error: function(data) { 
          //append error message and try again
         },
        cache: false,
        processData: false,
        contentType: false
      });  
    })
     
</script>
@endsection