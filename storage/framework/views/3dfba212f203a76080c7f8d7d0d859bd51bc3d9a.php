<?php $__env->startSection('title', 'МПС - добави'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">ДОБАВИ МПС</h4>                
            </div>
            <div class="card-body collapse in">
                <div class="card-block">      
                    <?php echo Form::open(['route' => 'trucks_store']); ?> 
                        <div class="form-body">
                           <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="number">РЕГ. НОМЕР НА МПС</label>
                                    <?php echo Form::text('number', old('number'), ['id'=>"number", 'class'=>"form-control",' placeholder'=>"Рег. номер на МПС ..."]); ?>

                                    <?php if($errors->has('number')): ?>
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        <?php echo e($errors->first('number')); ?> 
                                    </div>
                                    <?php endif; ?>  
                                </div>
                                <div class="form-group">
                                    <label for="truck_load">Тонаж</label>
                                    <?php echo Form::text('truck_load', old('truck_load'), ['id'=>"truck_load", 'class'=>"form-control",' placeholder'=>"Тонаж ..."]); ?>

                                    <?php if($errors->has('truck_load')): ?>
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        <?php echo e($errors->first('truck_load')); ?> 
                                    </div>
                                    <?php endif; ?>  
                                </div>
                            </div>                                    
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">                            
                                <label for="trucks_weight_category">Тонажна категория</label>
                                <?php echo Form::select('trucks_weight_category', $trucks_weight_categories, old('trucks_weight_category'), ['placeholder' => '-- изберете --', 'id' => 'trucks_weight_category', 'class'=>'form-control']); ?>                               
                                <?php if($errors->has('trucks_weight_category')): ?>
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        <?php echo e($errors->first('trucks_weight_category')); ?> 
                                    </div>
                                <?php endif; ?>                              
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">                            
                                <label for="trucks_weight_category">Офис</label>
                                <?php echo Form::select('office', $offices, old('office'), ['id' => 'office', 'class'=>'form-control']); ?>                            
                            </div>
                        </div>
                        <div class="form-actions">                                
                            <button type="submit" class="btn btn-primary">
                                <i class="far fa-save"></i> Запази
                            </button>
                        </div>
                    </div>
                <?php echo Form::close(); ?>

            </div>               
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>