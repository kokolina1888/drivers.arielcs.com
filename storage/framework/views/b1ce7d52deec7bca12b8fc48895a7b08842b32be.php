<?php $__env->startSection('title', 'ТОНАЖНА КАТЕГОРИЯ - добави'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">ДОБАВИ ТОНАЖНА КАТЕГОРИЯ</h4>                
            </div>
            <div class="card-body collapse in">
                <div class="card-block">                        
                    <form class="form" method="post" action="<?php echo e(route('trucks_weight_category_store')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-body">
                           <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="number">ИМЕ</label>
                                    <input type="text" id="name" class="form-control" placeholder="Име ..." name="name" value="<?php echo e(old('name')); ?>">
                                    <?php if($errors->has('name')): ?>
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        <?php echo e($errors->first('name')); ?> 
                                    </div>
                                    <?php endif; ?>  
                                </div>
                            </div>                                    
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="number">ЗАПЛАЩАНЕ</label>
                                    <input type="text" id="payment" class="form-control" placeholder="Заплащане ..." name="payment" value="<?php echo e(old('payment')); ?>">
                                    <?php if($errors->has('payment')): ?>
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        <?php echo e($errors->first('payment')); ?> 
                                    </div>
                                    <?php endif; ?>  
                                </div>
                            </div>                                    
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