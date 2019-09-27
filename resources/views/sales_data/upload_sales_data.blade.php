@extends('layouts.master')
@section('title', 'Файл - добави нов')


@section('content')
<div class="row">
    <div class="col-xs-12">
        @if (Session::has('success'))
            <div class="card-header">
                <div class="alert bg-success bg-accent-1 row">
                    <div class="col-md-8">
                        {{ Session::get('success') }} 
                    </div>
                    <div class="col-md-1 col-md-offset-3">                         
                        <div class="col-xs-1 col-xs-offset-11">
                            <a href="">x</a> 
                        </div>                                                                     
                    </div>   
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="fa fa-upload" aria-hidden="true"></i> ДОБАВЯНЕ НА СПРАВКА ПРОДАЖБИ С ДВЕ МЕРНИ ЕДИНИЦИ</h4>                
            </div>
            <div class="card-body collapse in">
                <div class="card-block">                        
                    <form class="form form-horizontal row-separator" method="post" enctype="multipart/form-data" action="{{ route('bulk_save_sales_data') }}">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <p><i>Качения файл ще намерите <a href="{{ route('sales_data_file_list', ['id', 'DESC']) }}">тук</a></i> Сортирайте по No на документ, преди запис на файла!</p>
                            <div class="row">
                                <div class="form-group col-sm-8">
                                    <div class="input-file-container">  
                                        <input class="input-file" id="my-file" type="file" name="document">
                                        <label tabindex="0" for="my-file" class="input-file-trigger label-control text-right">Добавете файл Справка продажби с две мерни единици
                                            <i class="fas fa-upload"></i>
                                        </label>
                                    </div>
                                    <p class="file-return"></p>                    
                                </div>                                
                            </div>                            
                        </div>
                    <!-- optional data -->                        
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
<div class="loader-container">
    <div class="loader">   
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
   $('.loader-container').css('display', 'none');
   $(document).on('click','#submit-form',function(e){
         $('.loader-container').css('display', 'block');
       });  
   $(document).ready(function(){
       $('[data-toggle="tooltip"]').tooltip(); 
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