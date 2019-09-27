<?php $__env->startSection('title', 'МПС - списък'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="fas fa-truck"></i> МПС - списък</h4>                
            </div>
            <?php if(Session::has('success')): ?>
            <div class="card-header">
                <div class="alert bg-success bg-accent-1 row">
                    <div class="col-md-8">
                        <?php echo e(Session::get('success')); ?> 
                    </div>
                    <div class="col-md-1 col-md-offset-3">                         
                        <div class="col-xs-1 col-xs-offset-11">
                            <a href="<?php echo e(route('trucks_list')); ?>">x</a> 
                        </div>                                                                     
                    </div>   
                </div>
            </div>
            <?php endif; ?>  
            <?php if(Session::has('error')): ?>
            <div class="card-header">
                <div class="alert bg-danger bg-accent-1 row">
                    <div class="col-md-8">
                        <?php echo e(Session::get('error')); ?> 
                    </div>
                    <div class="col-md-1 col-md-offset-3">                         
                        <div class="col-xs-1 col-xs-offset-11">
                            <a href="<?php echo e(route('trucks_list')); ?>">x</a> 
                        </div>                                                                     
                    </div>   
                </div>
            </div>
            <?php endif; ?>
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>МПС - РЕГ. НОМЕР</th>
                                    <th>Тонаж</th>
                                    <th>Тонажна категория</th>
                                    <th class="col-xs-1 text-center">Офис</th>
                                    <th class="col-xs-1 text-center">Статус</th>
                                    <?php if( Auth::user()->role == 'admin'): ?>
                                        <th class="col-xs-1 text-center">***</th>
                                        <th class="col-xs-1 text-center">деактивиран на:</th>
                                        <th class="col-xs-1 text-center">***</th>
                                        <th class="col-xs-1 text-center">***</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>                            
                            <tbody>
                                    <?php if( !$trucks->isEmpty() ): ?>
                                        <?php
                                        $num = 1;
                                        ?>
                                        <?php $__currentLoopData = $trucks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr <?php if($t->status === 0): ?> class="driver-inactive" <?php endif; ?>>
                                            <th scope="row"><?php echo e($num++); ?></th>
                                            <td><?php echo e($t->number); ?></td>
                                            <td><?php if($t->truck_load != 0 ): ?><?php echo e($t->truck_load); ?> <?php else: ?> не е въведен <?php endif; ?></td>
                                            <td><?php if( isset($t->trucks_weight_category->name)): ?><?php echo e($t->trucks_weight_category->name); ?> <?php else: ?> не е въведена <?php endif; ?></td>
                                            <td><?php if( isset( $t->office ) ): ?> <?php echo e($t->office->name); ?><?php else: ?> не е въведен офис <?php endif; ?></td>

                                            <?php if( $t->status == 0): ?> <td class="driver-inactive status">неактивен</td> <?php else: ?> <td class="status">активен</td> <?php endif; ?>
                                            <?php if( Auth::user()->role == 'admin'): ?>                                                                                      
                                                <td>                                            
                                                    <?php if( $t->status === 1): ?>
                                                        <button type="button" class="toggle-status btn btn-primary" data-status="<?php echo e($t->status); ?>" data-truck="<?php echo e($t->id); ?>"> 
                                                            деАКТИВИРАЙ
                                                        </button>
                                                    <?php else: ?> 
                                                        <button class="toggle-status btn btn-secondary" type="button"  data-status="<?php echo e($t->status); ?>" data-truck="<?php echo e($t->id); ?>"> 
                                                            АКТИВИРАЙ
                                                        </button>
                                                    <?php endif; ?>                                                  
                                                </td>
                                                <td class="date-deactivated">
                                                    <?php if( $t->date_deactivated ): ?>
                                                        <i><?php echo e(date('d-m-Y', strtotime($t->date_deactivated))); ?></i>
                                                    <?php endif; ?>
                                                </td>
                                                <td><a href="<?php echo e(route('trucks_edit', $t->id )); ?>" class="btn btn-warning mr-1 mb-1" data-toggle="tooltip"  data-placement="left" title="Редактирай"><i class="far fa-edit"></i></a></td>
                                                <td>
                                                    <form action="<?php echo e(route('trucks_destroy', $t->id)); ?>" method="post">
                                                    <?php echo e(csrf_field()); ?>

                                                        <button type="submit" class="btn btn-danger mr-1 mb-1" data-toggle="tooltip" data-placement="left" title="Изтрий! Няма да бъде изтрит е въведен в пътен лист!"><i class="fa fa-times" aria-hidden="true"></i>
                                                    </button>
                                                    </form>                                         
                                                </td> 
                                            <?php endif; ?>                                   
                                        </tr>                               
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?> 
                                        <tr>
                                            <td colspan="4">
                                                Няма добавени автомобили!
                                            </td>
                                        </tr>
                                    <?php endif; ?>                              
                                </tbody>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    var token = "<?php echo e(Session::token()); ?>";   
    var host = "<?php echo e(URL::to('/')); ?>";        
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });
    
    $('.toggle-status').on('click', function(e){
    e.preventDefault();
    var truckStatus = $(this).data('status'),
        truck = $(this).data('truck');
    $.ajax({
      url:host+'/trucks-change-status/'+truck+'/'+truckStatus,      
      type: 'POST',
      success: function(response) {        
       //change button title according to status   
       var element = $('[data-truck="'+truck+'"]'), elementTd = element.parents('td');
       if(response.status == 1){        
        
            element.removeClass('btn-secondary').addClass('btn-primary');
            element.html('деАКТИВИРАЙ');
            element.data('status', 1);
            elementTd.siblings('.status').html('активен');
            elementTd.siblings('.date-deactivated').html('');               
            elementTd.parents('tr').removeClass('driver-inactive')

       } else if(response.status == 0){
            element.removeClass('btn-primary').addClass('btn-secondary');
            element.html('АКТИВИРАЙ');  
            element.data('status', 0);
            elementTd.siblings('.status').html('неактивен');  
            elementTd.siblings('.date-deactivated').html('<i><?php echo e(date("d-m-Y")); ?></i>');  
            elementTd.parents('tr').addClass('driver-inactive')
       } 
      },
      error: function(data) { //append error message and try again
       },
      cache: false,
      processData: false,
      contentType: false

    });
   
  });
  
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>