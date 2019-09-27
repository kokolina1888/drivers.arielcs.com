<?php $__env->startSection('title', 'Офис - добави нов'); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">ДОБАВИ НОВ ОФИС</h4>                
            </div>
            <div class="card-body collapse in">
                <div class="card-block">                        
                    <form class="form" action="<?php echo e(route('offices_store')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-body">
                           <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Офис</label>
                                        <input type="text" id="name" class="form-control" placeholder="Офис ..." name="name" value="<?php echo e(old('name')); ?>">
                                        <?php if($errors->has('name')): ?>
                                        <div class="col-sm-7 col-sm-offset-1 text-danger">
                                            <?php echo e($errors->first('name')); ?> 
                                        </div>
                                        <?php endif; ?>  
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">                            
                                <label for="office">Тип</label>
                                <select id="is_sofia" name="is_sofia" class="form-control">
                                    <option value="0">провинция</option>
                                    <option value="1">София</option>
                                </select>  
                                <?php if($errors->has('is_sofia')): ?>
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        <?php echo e($errors->first('is_sofia')); ?> 
                                    </div>
                                 <?php endif; ?>  
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>