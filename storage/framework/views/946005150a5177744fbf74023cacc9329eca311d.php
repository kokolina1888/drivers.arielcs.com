<?php $__env->startSection('title', 'ТОНАЖНИ КАТЕГОРИИ - списък'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Тонажни категории - списък</h4>                
            </div>
            <?php if(Session::has('success')): ?>
            <div class="card-header">
                <div class="alert bg-success bg-accent-1 row">
                    <div class="col-md-8">
                        <?php echo e(Session::get('success')); ?> 
                    </div>
                    <div class="col-md-1 col-md-offset-3">                         
                        <div class="col-xs-1 col-xs-offset-11">
                            <a href="<?php echo e(route('trucks_weight_categories_list')); ?>">x</a> 
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
                            <a href="<?php echo e(route('trucks_weight_categories_list')); ?>">x</a>
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
                                    <th>Тонажна категория</th>
                                    <th>Заплащане</th>
                                    <?php if( Auth::user()->role == 'admin'): ?>
                                    <th>***</th>
                                    <th>***</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>                            
                            <tbody>
                                    <?php if( !$trucks_weight_categories->isEmpty() ): ?>
                                        <?php
                                        $num = 1;
                                        ?>
                                        <?php $__currentLoopData = $trucks_weight_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $twc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row"><?php echo e($num++); ?></th>
                                            <td><?php echo e($twc->name); ?></td>
                                            <td><?php echo e($twc->payment); ?></td>
                                            <?php if( Auth::user()->role == 'admin'): ?>
                                            <td><a href="<?php echo e(route('trucks_weight_category_edit', $twc->id )); ?>" class="btn btn-warning mr-1 mb-1" data-toggle="tooltip"  data-placement="left" title="Редактирай"><i class="far fa-edit"></i></a></td>
                                            <td>
                                                <form action="<?php echo e(route('trucks_weight_category_destroy', $twc->id)); ?>" method="post">
                                                <?php echo e(csrf_field()); ?>

                                                    <button type="submit" class="btn btn-danger mr-1 mb-1" data-toggle="tooltip" data-placement="left" title="Изтрий! Няма да бъде изтрита е въведена към МПС!"><i class="fa fa-times" aria-hidden="true"></i>
                                                    </button>
                                                </form>                                         
                                            </td>  
                                            <?php endif; ?>                                  
                                        </tr>                               
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?> 
                                        <tr>
                                            <td colspan="4">
                                                Няма добавени тонажни категории!
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>