@extends('layouts.master')
@section('title', 'Пътен лист - добави нов')


@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="fas fa-boxes"></i> ДОБАВЯНЕ НА ПЪТЕН ЛИСТ</h4>                
            </div>
            <div class="card-body collapse in">
                <div class="card-block">                        
                    <form class="form form-horizontal row-separator" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-body">
                        <!-- drivers and order -->
                            <div class="form-group row">              
                            	<div class="col-sm-4">                  
                                	<label for="on" class="col-md-8 control-label">Заповед No /водач 1/</label>
                                	<div class="col-md-12">
                                	    <input type="text" id="on" class="form-control" value="" placeholder="Заповед No ..." name="order_number">
                                	    <div class="col-sm-12 text-danger" id="order_number">                                       
                                	    </div>                                   
                                	</div>
                                </div>                                
                                <div class="col-md-8">
                                	<label for="d1" class="col-sm-12 control-label">Водач 1</label>
                                    <select id="d1" name="driver1" class="form-control">
                                        <option value="">-- изберете --</option>
                                        @foreach( $drivers as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach                                                
                                    </select>
                                    <div class="col-sm-7 col-sm-offset-1 text-danger" id="driver1">
                                    </div>
                                </div>                                 
                            </div>
                            <div class="form-group row">              
                            	<div class="col-sm-4">                  
                                	<label for="on2" class="col-sm-8 control-label">Заповед No /водач 2/</label>
                                	<div class="col-sm-12">
                                	    <input type="text" id="on2" class="form-control" value="" placeholder="Заповед No ..." name="order_number2">
                                	    <div class="col-sm-12 text-danger" id="order_number2">                                       
                                	    </div>                                   
                                	</div>
                                </div>                                
                                <div class="col-md-8">
                                	<label for="d2" class="col-sm-12 control-label">Водач 2</label>
                                    <div class="col-sm-12">
                                        <select id="d2" name="driver2" class="form-control">
                                            <option value="">-- изберете --</option>
                                            @foreach( $drivers as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach                                                
                                        </select>
                                        <div class="col-sm-7 col-sm-offset-1 text-danger" id="driver2">
                                        </div>
                                    </div>
                                </div>                                 
                            </div>
                           <!-- drivers and order end -->
                            <div class="form-group row">                                
                                <label for="rl" class="col-md-2 label-control text-right">Пътен лист</label>
                                <div class="col-md-10">
                                    <input type="text" id="rl" class="form-control" value="" placeholder="Пътен лист ..." name="route_list">
                                    <div class="col-sm-7 col-sm-offset-1 text-danger" id="route_list">                                      
                                    </div>                                    
                                </div>                                 
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 label-control text-right" for="t">МПС</label>
                                <div class="col-md-10">
                                    <select id="t" name="truck" class="form-control">
                                        <option value="">-- изберете --</option>
                                        @foreach( $trucks as $t)
                                        <option value="{{ $t->id }}">{{ $t->number }}</option>
                                        @endforeach                                                
                                    </select>
                                    <div class="col-sm-7 col-sm-offset-1 text-danger" id="truck">                                      
                                    </div>   
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">                                
                                    <label for="km_s" class="col-md-4 control-label">Начален километраж</label>
                                    <div class="col-md-12">
                                        <input type="text" id="km_s" class="form-control" value="{{ old('') }}" placeholder="Начален километраж ..." name="km_start">   
                                        <div class="col-sm-7 col-sm-offset-1 text-danger" id="km_start">
                                        </div>                                    
                                    </div>                              
                                </div>  
                                <div class="col-sm-4">                                
                                    <label for="km_e" class="col-md-4 control-label">Краен километраж</label>
                                    <div class="col-md-12">
                                        <input type="text" id="km_e" class="form-control" value="{{ old('') }}" placeholder="Краен километраж ..." name="km_e">
                                        <div class="col-sm-7 col-sm-offset-1 text-danger" id="km_end">
                                        </div>  
                                    </div>                              
                                </div>                                
                                <div class="col-sm-4">                                
                                    <label for="km_r" class="col-md-4 control-label">Изминати километри</label>
                                    <div class="col-md-12">
                                        <input type="text" id="km_r" class="form-control" value="" placeholder="Изминати километри ..." name="km_run">
                                        <div class="col-sm-7 col-sm-offset-1 text-danger" id="km_run">
                                        </div>
                                    </div>                              
                                </div>
                            </div> 
                            <div class="form-group row">  
                                <div class="col-sm-4">                                
                                    <label for="gas_q" class="col-md-4 control-label">Заредено гориво</label>
                                    <div class="col-md-12">
                                        <input type="text" id="gas_q" class="form-control" value="" placeholder="Заредено гориво ..." name="gas_quant">
                                        <div class="col-sm-7 col-sm-offset-1 text-danger" id="gas_quant">
                                        </div>   
                                    </div>                              
                                </div>
                                <div class="col-sm-8">  
                                	<label class="col-sm-2" for="note"><i>Забележка</i></label>                            
                            		<div class="col-sm-10">                                                                
                            		    <textarea id="note" name="note" cols="100">
                            		    </textarea>           
                            		</div>
                            	</div>
                            </div>
                            <div class="form-group row">
                                <div class="doc-list-container col-sm-4">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">No товарителница</th>
                                                <th class="text-center">***</th>
                                            </tr>
                                        </thead>                                                                     
                                        <tbody></tbody>
                                    </table> 
                                    <button id="add-doc-to-list" type="button" style="border-radius: 5px; background-color: #fff; color: green;" data-toggle="modal" data-target="#documents-list-modal">+ Добави товарителници</button>
                                </div>                                              
                            </div> 
                            <!-- Modal -->
                            <div class="modal fade" id="documents-list-modal" tabindex="-1" role="dialog" aria-labelledby="documents-list-modal" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                   <label for="document-search" class="control-label">Въведи номер на товарителница <span data-toggle="tooltip" data-placement="right" title="Резултатът ще съдържа само свободни товарителници /неасоциирани с пътен лист/"><i class="fas fa-info-circle"></i></span></label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">                                    
                                    <input type="text" class="form-control" name="document-search" id="document-search">
                                  </div>
                                  <div id="documents-suggestion">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Затвори</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Modal end -->
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
$('#documents-list-modal').on('shown.bs.modal', function() {
  $('#document-search').focus();
});
$('#document-search').on('input', function(){
    var searchStr = $(this).val();    
    if(searchStr.length > 2){
        let data = new FormData();    
        data.append('search_str', searchStr);
        // console.log(searchStr);       
        $.ajax({
          url:host+'/get-documents-to-append',
          data: data,
          type: 'POST',
          success: function(response) { 
            $('#documents-suggestion').html('');
            var parent = $('<ul></ul>');
            for(var ind in response.documents){
                var curResp = response.documents[ind];                
                parent.append('<li><a href="#" class="document-to-append" id="'+curResp.id+'">'+curResp.document_number+'-'+curResp.total_weight+' кг</a></li>');
            }
            $('#documents-suggestion').append(parent);
          },
          error: function(data) { 
            //append error message and try again
           },
          cache: false,
          processData: false,
          contentType: false
        });   
    }
});

$('body').on('click', '.document-to-append', function(e){
    e.preventDefault();
    var docToAppendId = $(this).attr('id'),
        docToAppendData = $(this).html(),
        documentData = '', num;
        documentData += '<tr>';
        num = $('.document-row-num:last').html();
        num ? num=num : num=0;
        num++;
      
        documentData += '<td class="document-row-num">'+num+'</td>';
        
        documentData += '<td class="document-info" data-document="'+docToAppendId+'">'+docToAppendData+'</td>';
        documentData += '<td class="text-center"><button class="document-delete btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';        
        documentData += '</tr>';
        $('#documents-list-modal').modal('toggle');
        $('#documents-suggestion').html('');
        $('.doc-list-container table tbody').append(documentData);
       
});

$('#submit-form').on('click', function(e){
    e.preventDefault();
    $.each($('.text-danger'), function(k, v){
        v.innerHTML = '';
    });
    var orderNumber = $("#on").val(),    	
        routeList   = $('#rl').val(),
        truck       = $('#t').val(),
        km_start    = $('#km_s').val(),
        km_end      = $('#km_e').val(),
        gas_quant   = $('#gas_q').val(),
        km_run      = $('#km_r').val(),
        driver1     = $('#d1').val(),
        driver2     = $('#d2').val(),
        attachedDocuments   = [],
        docsToAttach    = $('.document-info'),
        note            = $('#note').val(), orderNumber2;

        orderNumber2 = $('#on2').val();
         
        docsToAttach.each(function(e) {          
          attachedDocuments.push(docsToAttach[e].dataset.document);
        });
          
        let data = new FormData();    
        data.append('order_number', orderNumber);
        data.append('order_number2', orderNumber2);
        data.append('route_list', routeList);
        data.append('truck', truck);
        data.append('km_start', km_start);
        data.append('km_end', km_end);
        data.append('gas_quant', gas_quant);
        data.append('km_run', km_run);
        data.append('driver1', driver1);
        data.append('driver2', driver2);
        data.append('attached_documents', attachedDocuments);
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
            success: function(response) { 
                //append success message - go to routes list!
                location = host + '/route-lists-list/id/DESC';
            },
            error: function(response) { 
             },
            statusCode: {
                422: function (resp) {
                        $.each(resp.responseJSON.errors, function (k, v) {
                          $('#'+k).html(v);
                        });
                }
            },
            cache: false,
            processData: false,
            contentType: false
        });    
 
});

$('body').on('click', 'button.document-delete', function(e){
    e.preventDefault();
    $(this).parents('tr').remove();
    var rowNums = $('.document-row-num'), num=1;
    rowNums.each(function(ind) {
        rowNums[ind].innerHTML = num++;
    })
})
</script>
@endsection