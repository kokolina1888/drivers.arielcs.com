<?php $__env->startSection('title', 'Пътен лист - редактиране'); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">РЕДАКТИРАНЕ НА ПЪТЕН ЛИСТ</h4>                
            </div>
            <div class="card-body collapse in">
                <div class="card-block">                        
                    <form class="form form-horizontal row-separator" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>                        
                        <input type="hidden" name="page" id="page" value="<?php echo e($page); ?>">
                        <div class="form-body">
                            <div class="form-group row">                                
                                <div class="col-sm-4">                  
                                    <label for="on" class="col-md-4 control-label">Заповед No /водач 1/</label>                                    
                                    <div class="col-sm-12">
                                        <input type="text" id="on" class="form-control" value="<?php echo e($route_list->order_number); ?>" placeholder="Заповед No ..." name="order_number">
                                        <div class="col-sm-7 col-sm-offset-1 text-danger" id="order_number">
                                        </div>                                   
                                    </div> 
                                </div>                                
                                <div class="col-sm-8"> 
                                    <label for="d1" class="col-sm-12 control-label">Водач 1</label>                                    
                                    <div class="col-sm-12">
                                        <select id="d1" name="driver1" class="form-control">
                                            <option value="">-- изберете --</option>
                                            <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($d->id); ?>" <?php if( $route_list->first_driver_id == $d->id){ echo 'selected'; }?>><?php echo e($d->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                
                                        </select>
                                        <div class="col-sm-7 col-sm-offset-1 text-danger" id="driver1">                                       
                                        </div>
                                    </div>                                   
                                </div>
                            </div>
                            <div class="form-group row">              
                                <div class="col-sm-4">                  
                                    <label for="on2" class="col-sm-4 control-label">Заповед No /водач 2/</label>
                                    <div class="col-sm-12">
                                        <input type="text" id="on2" class="form-control" value="<?php echo e($route_list->order_number2); ?>" placeholder="Заповед No ..." name="order_number2">
                                        <div class="col-sm-12 text-danger" id="order_number2">                                       
                                        </div>                                   
                                    </div>
                                </div>                                
                                <div class="col-md-8">
                                    <label for="d2" class="col-sm-12 control-label">Водач 2</label>
                                    <div class="col-sm-12">
                                        <select id="d2" name="driver2" class="form-control">
                                            <option value="">-- изберете --</option>
                                            <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($d->id); ?>" <?php if( $route_list->second_driver_id == $d->id){ echo 'selected'; }?>><?php echo e($d->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                
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
                                    <input type="text" id="rl" class="form-control" value="<?php echo e($route_list->route_list_number); ?>" placeholder="Пътен лист ..." name="route_list">
                                    <div class="col-sm-7 col-sm-offset-1 text-danger" id="route_list">                                       
                                    </div>
                                </div>                                 
                            </div>
                           
                            <div class="form-group row">
                                <label class="col-md-2 label-control text-right" for="t">МПС</label>
                                <div class="col-md-10">
                                    <select id="t" name="truck" class="form-control">
                                        <option value="">-- изберете --</option>
                                        <?php $__currentLoopData = $trucks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($t->id); ?>" <?php if( $route_list->truck_id == $t->id){ echo 'selected'; }?>><?php echo e($t->number); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                
                                    </select>
                                    <div class="col-sm-7 col-sm-offset-1 text-danger" id="truck">                                       
                                    </div>
                                </div>
                            </div>                           
                            <div class="form-group row">
                                <div class="col-sm-4">                                
                                    <label for="km_s" class="col-md-4 control-label">Начален километраж</label>
                                    <div class="col-md-12">
                                        <input type="text" id="km_s" class="form-control" value="<?php echo e($route_list->km_start); ?>" placeholder="Начален километраж ..." name="km_start"> 
                                        <div class="col-sm-7 col-sm-offset-1 text-danger" id="km_start">                                       
                                        </div>
                                    </div>                              
                                </div>  
                                <div class="col-sm-4">                                
                                    <label for="km_e" class="col-md-4 control-label">Краен километраж</label>
                                    <div class="col-md-12">
                                        <input type="text" id="km_e" class="form-control" value="<?php echo e($route_list->km_end); ?>" placeholder="Краен километраж ..." name="km_end">
                                        <div class="col-sm-7 col-sm-offset-1 text-danger" id="km_end">                                       
                                        </div>    
                                    </div>                              
                                </div>                                
                                <div class="col-sm-4">  
                                    <label for="km_r" class="col-md-4 control-label">Изминати километри</label>
                                    <div class="col-md-12">
                                        <input type="text" id="km_r" class="form-control" value="<?php echo e($route_list->km_run); ?>" placeholder="Изминати километри ..." name="km_run">
                                        <div class="col-sm-8 col-sm-offset-1 text-danger" id="km_run">                                       
                                        </div>               
                                    </div>
                                </div> 
                            </div>   
                            <div class="form-group row">                             
                                <div class="col-sm-4">                                
                                    <label for="gas_q" class="col-md-4 control-label">Заредено гориво</label>
                                    <div class="col-md-12">
                                        <input type="text" id="gas_q" class="form-control" value="<?php echo e($route_list->gas_quant); ?>" placeholder="Заредено гориво ..." name="gas_quant">
                                        <div class="col-sm-8 col-sm-offset-1 text-danger" id="gas_quant">                                       
                                        </div>
                                    </div>                               
                                </div>
                                <div class="col-sm-8">
                                    <label class="col-sm-12" for="note"><i>Забележка</i></label>                            
                                    <div class="col-sm-12">                                                                
                                        <textarea id="note" name="note" cols="100">
                                            <?php echo e($route_list->note); ?>

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
                                        <tbody>
                                        <?php if( $documents->count() > 0): ?>
                                            <?php $row_num = 1; ?>
                                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="document-row-num"><?php echo e($row_num++); ?></td>        
                                                <td class="document-info" data-document="<?php echo e($d->id); ?>">
                                                    <?php echo e($d->document_number); ?> - <?php echo e($d->total_weight); ?> кг.
                                                </td>
                                                <td class="text-center">
                                                    <button class="document-delete btn btn-danger">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </td>       
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        </tbody>
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
                        </div>
                    <!-- optional data -->
                        <div class="row form-group">                             
                            <div class="col-sm-12 bg-warning">                                                                
                                <input class="form-check-input" type="checkbox" <?php if((old('is_international') == 1) || ($route_list->is_international == 1)) { echo "checked"; } ?> value="1" id="is_international">
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
  var token = "<?php echo e(Session::token()); ?>";   
  var host = "<?php echo e(URL::to('/')); ?>";        
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
    var routeListId = '<?php echo e($route_list->id); ?>',
        orderNumber = $("#on").val(),
        routeList   = $('#rl').val(),
        truck       = $('#t').val(),
        km_start    = $('#km_s').val(),
        km_end      = $('#km_e').val(),
        gas_quant   = $('#gas_q').val(),
        km_run      = $('#km_r').val(),
        driver1     = $('#d1').val(),
        driver2     = $('#d2').val(),
        attachedDocuments   = [],
        docsToAttach = $('.document-info'),
        note        = $('#note').val(), 
        //filters, sort data, pagination
        page        = '<?php echo e($page); ?>', 
        order       = '<?php echo e($order); ?>', 
        direction   = '<?php echo e($direction); ?>', 
        filter_date = '<?php echo e($filter_date); ?>', 
        filter_first_driver = '<?php echo e($filter_first_driver); ?>', 
        filter_second_driver = '<?php echo e($filter_second_driver); ?>', 
        filter_truck = '<?php echo e($filter_truck); ?>', 
        filter_order_number = '<?php echo e($filter_order_number); ?>',
        orderNumber2;

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
        //filters, sort data, pagination
        data.append('page', page); 
        data.append('order', order); 
        data.append('direction', direction); 
        data.append('filter_date', filter_date); 
        data.append('filter_first_driver', filter_first_driver); 
        data.append('filter_second_driver', filter_second_driver); 
        data.append('filter_truck', filter_truck); 
        data.append('filter_order_number', filter_order_number); 
       
        if( $('#is_international').is(":checked") ){
             data.append('is_international', 1);
        } else {
            data.append('is_international', 0);
        }

        $.ajax({
            url:host+'/route-list-update/'+routeListId,
            data: data,
            type: 'POST',
            success: function(response) { 
                console.log(response);
            var filter_date = response.date;
            var filter_truck = response.filter_truck ? response.filter_truck : '';
            var filter_first_driver = response.filter_first_driver ? response.filter_first_driver : '';
            var filter_second_driver = response.filter_second_driver ? response.filter_second_driver : '';
            var filter_order_number = response.order_number ? response.order_number : '';
            var page = response.page ? response.page : 1;
           
            var query = '?date='+filter_date+'&truck='+filter_truck+'&first_driver='+filter_first_driver;
                query+='&second_driver='+filter_second_driver+'&order_number='+filter_order_number+'&page='+page;
                location = host + '/route-lists-list/'+response.order+'/'+ response.direction +query;           
            },
            error: function(data) { 
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>