<?php $__env->startSection('title', 'Документи - ръчно въвеждане на данни'); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="fas fa-pencil-alt"></i> ВЪВЕДЕТЕ ДАННИ ЗА ТОВАР</h4>                
            </div>
            <div class="card-body collapse in">
                <div class="card-block">                        
                    <form class="form form form-horizontal row-separator" action="<?php echo e(route('store_handentered_data')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-body">
                            <input type="hidden" name="is_handentered" value="1">
                            <!-- driver 1 data -->
                            <div class="form-group row">              
                                <div class="col-sm-4">                  
                                    <label for="on" class="col-md-8 control-label">Заповед No /водач 1/</label>
                                    <div class="col-md-12">
                                        <input type="text" id="on" class="form-control" value="<?php echo e(old('order_number')); ?>" placeholder="Заповед No ..." name="order_number">
                                        <div class="col-sm-12 text-danger" id="order_number">  
                                        <?php if($errors->has('order_number')): ?>
                                            <div class="col-sm-7 col-sm-offset-1 text-danger">
                                                <?php echo e($errors->first('order_number')); ?> 
                                            </div>
                                        <?php endif; ?>                                      
                                        </div>                                   
                                    </div>
                                </div>                                
                                <div class="col-md-8">
                                    <label for="d1" class="col-sm-12 control-label">Водач 1</label>
                                    <select id="d1" name="driver1" class="form-control">
                                        <option value="">-- изберете --</option>
                                        <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($d->id); ?>" <?php if(old('driver1') == $d->id) { echo "selected"; } ?>><?php echo e($d->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                
                                    </select>
                                    <?php if($errors->has('driver1')): ?>
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            <?php echo e($errors->first('driver1')); ?> 
                                        </div>
                                    <?php endif; ?>                                     
                                </div>                                 
                            </div>
                            <!-- driver 2 data -->
                             <div class="form-group row">              
                                <div class="col-sm-4">                  
                                    <label for="on2" class="col-sm-8 control-label">Заповед No /водач 2/</label>
                                    <div class="col-sm-12">
                                        <input type="text" id="on2" class="form-control" value="<?php echo e(old('order_number2')); ?>" placeholder="Заповед No ..." name="order_number2">
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
                                            <option value="<?php echo e($d->id); ?>" <?php if(old('driver2') == $d->id) { echo "selected"; } ?>><?php echo e($d->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                
                                        </select>
                                        <?php if($errors->has('driver2')): ?>
                                            <div class="col-sm-7 col-sm-offset-1 text-danger">
                                                <?php echo e($errors->first('driver2')); ?> 
                                            </div>
                                        <?php endif; ?> 
                                    </div>
                                </div>                                 
                            </div>
                           <!-- drivers and order end -->
                            <div class="row form-group">                                
                                <div class="col-sm-6">                                
                                    <label for="date" class="col-sm-2 control-label">Дата</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="date" class="form-control" value="<?php echo e(old('date')); ?>" placeholder="дата" name="date">
                                        <?php if($errors->has('date')): ?>
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            <?php echo e($errors->first('date')); ?> 
                                        </div>
                                        <?php endif; ?> 
                                    </div>                                 
                                </div>    
                                <div class="col-sm-6">                                
                                    <label for="rl" class="col-sm-2 control-label">Пътен лист</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="rl" class="form-control" value="<?php echo e(old('route_list')); ?>" placeholder="Пътен лист ..." name="route_list">
                                        <?php if($errors->has('route_list')): ?>
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            <?php echo e($errors->first('route_list')); ?> 
                                        </div>
                                        <?php endif; ?> 
                                    </div>                                 
                                </div>                    
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-8">                                
                                    <label for="document" class="col-sm-3 control-label">Товарителница No</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="document" class="form-control" value="<?php echo e(old('document')); ?>"  placeholder="Товарителница номер ...." name="document">
                                        <?php if( $errors->has('document') ): ?>
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            <?php echo e($errors->first('document')); ?> 
                                        </div>
                                        <?php endif; ?>    
                                    </div>                              
                                </div>  
                                <div class="col-sm-4">                                
                                    <label for="total_weight" class="col-sm-2 control-label">Тегло</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="total_weight" class="form-control" value="<?php echo e(old('total_weight')); ?>"  placeholder="Тегло ..." name="total_weight">
                                        <?php if($errors->has('total_weight')): ?>
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            <?php echo e($errors->first('total_weight')); ?> 
                                        </div>
                                        <?php endif; ?>    
                                    </div>                              
                                </div>                                
                            </div>     
                            <div class="form-group row">
                                <label class="col-md-2 label-control text-right" for="t">МПС</label>
                                <div class="col-md-10">
                                    <select id="t" name="truck" class="form-control">
                                        <option value="">-- изберете --</option>
                                        <?php $__currentLoopData = $trucks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($t->id); ?>" <?php if(old('truck') == $t->id) { echo "selected"; } ?>><?php echo e($t->number); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                
                                    </select>
                                    <?php if($errors->has('truck')): ?>
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            <?php echo e($errors->first('truck')); ?> 
                                        </div>
                                    <?php endif; ?>  
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">                                
                                    <label for="km_s" class="col-md-4 control-label">Начален километраж</label>
                                    <div class="col-md-12">
                                        <input type="text" id="km_s" class="form-control" value="<?php echo e(old('km_start')); ?>" placeholder="Начален километраж ..." name="km_start">   
                                        <div class="col-sm-7 col-sm-offset-1 text-danger" id="km_start">
                                        </div>                                    
                                    </div> 
                                    <?php if($errors->has('km_start')): ?>
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            <?php echo e($errors->first('km_start')); ?> 
                                        </div>
                                    <?php endif; ?>                              
                                </div>  
                                <div class="col-sm-4">                                
                                    <label for="km_e" class="col-md-4 control-label">Краен километраж</label>
                                    <div class="col-md-12">
                                        <input type="text" id="km_e" class="form-control" value="<?php echo e(old('km_end')); ?>" placeholder="Краен километраж ..." name="km_end">
                                        <div class="col-sm-7 col-sm-offset-1 text-danger" id="km_end">
                                        </div>  
                                    </div>  
                                    <?php if($errors->has('km_end')): ?>
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            <?php echo e($errors->first('km_end')); ?> 
                                        </div>
                                    <?php endif; ?>                             
                                </div>                                
                                <div class="col-sm-4">                                
                                    <label for="km_r" class="col-md-4 control-label">Изминати километри</label>
                                    <div class="col-md-12">
                                        <input type="text" id="km_r" class="form-control" value="<?php echo e(old('km_run')); ?>" placeholder="Изминати километри ..." name="km_run">
                                        <div class="col-sm-7 col-sm-offset-1 text-danger" id="km_run">
                                        </div>
                                    </div> 
                                    <?php if($errors->has('km_run')): ?>
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            <?php echo e($errors->first('km_run')); ?> 
                                        </div>
                                    <?php endif; ?>                              
                                </div>
                            </div> 
                            <div class="form-group row">  
                                <div class="col-sm-4">                                
                                    <label for="gas_q" class="col-md-4 control-label">Заредено гориво</label>
                                    <div class="col-md-12">
                                        <input type="text" id="gas_q" class="form-control" value="<?php echo e(old('gas_quant')); ?>" placeholder="Заредено гориво ..." name="gas_quant">
                                        <div class="col-sm-7 col-sm-offset-1 text-danger" id="gas_quant">
                                        </div>   
                                    </div>
                                    <?php if($errors->has('gas_quant')): ?>
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            <?php echo e($errors->first('gas_quant')); ?> 
                                        </div>
                                    <?php endif; ?>                               
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-8">  
                                    <label class="col-sm-2" for="note"><i>Забележка</i></label>                            
                                    <div class="col-sm-10">                                                                
                                        <textarea id="note" name="note" cols="100">
                                            <?php echo e(old('note')); ?>

                                        </textarea>           
                                    </div>
                                </div>
                            </div>            
                            <div class="row form-group">
                                <div class="col-sm-12">                                
                                    <label for="doc_receiver" class="col-md-3 control-label">Товарителница получател</label>
                                    <div class="col-md-9">
                                        <input type="text" id="doc_receiver" class="form-control" value="<?php echo e(old('doc_receiver')); ?>" placeholder="Товарителница получател ..." name="doc_receiver">
                                        <?php if($errors->has('doc_receiver')): ?>
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            <?php echo e($errors->first('doc_receiver')); ?> 
                                        </div>
                                        <?php endif; ?>    
                                    </div>                              
                                </div>
                            </div> 
                            <div class="row form-group">
                                <div class="col-sm-12">                                
                                    <label for="doc_receiver_address_address" class="col-md-3 control-label">Получател - адрес/населено място</label>
                                    <div class="col-md-9">
                                        <input type="text" id="doc_receiver_address" class="form-control" value="<?php echo e(old('doc_receiver_address')); ?>" placeholder="Получател адрес ..." name="doc_receiver_address">
                                        <?php if($errors->has('doc_receiver_address')): ?>
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            <?php echo e($errors->first('doc_receiver_address')); ?> 
                                        </div>
                                        <?php endif; ?>    
                                    </div>                              
                                </div>
                            </div>                                                        
                            <!-- optional data -->
                            <div class="row form-group">
                                <div class="col-sm-3 bg-warning">                                
                                    <input class="form-check-input" type="checkbox" value="1" name="is_international" <?php if(old('is_international') == 1) { echo "checked"; } ?> id="is_international">
                                    <label class="form-check-label" for="is_international">
                                        Международен
                                    </label>               
                                </div> 
                                <div class="col-sm-9 bg-success">
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="radio" <?php if(old('sender') == 'РОСТАР БГ') { echo "checked"; } ?> name="sender" id="rostar" value="РОСТАР БГ">
                                        <label class="form-check-label" for="rostar">
                                          РОСТАР БГ
                                        </label>
                                    </div> 
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="radio" <?php if(old('sender') == 'ВИВЕКТА БГ') { echo "checked"; } ?> name="sender" id="vivekta" value="ВИВЕКТА БГ">
                                        <label class="form-check-label" for="vivekta">
                                          ВИВЕКТА БГ
                                        </label>
                                    </div> 
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="radio" <?php if(old('sender') == 'ЧУЖД') { echo "checked"; } ?> name="sender" id="is_foreign" value="ЧУЖД">
                                        <label class="form-check-label" for="is_foreign">
                                          ЧУЖД
                                        </label>
                                    </div> 
                                </div>
                                <?php if($errors->has('sender')): ?>
                                    <div class="col-sm-12 col-sm-offset-4 text-danger">
                                        <?php echo e($errors->first('sender')); ?> 
                                    </div>
                                <?php endif; ?> 
                            </div>
                        </div>   
                        <div class="form-actions">                                
                            <button type="submit" class="btn btn-primary">
                                <i class="far fa-save"></i> Запази
                            </button>
                        </div>       
                    </div>                

            </form>
        </div>               
    </div>
</div>
</div>
</div>
<script type="text/javascript">

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>