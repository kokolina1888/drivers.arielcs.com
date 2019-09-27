<?php $__env->startSection('title', 'Вход'); ?>

<?php $__env->startSection('content'); ?>
<div class="content-body"><section class="flexbox-container">
        <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header no-border">
                    <div class="card-title text-xs-center">
                        <div class="p-1"><img src="" alt="Logo"></div>
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Вход</span></h6>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <form class="form-horizontal form-simple" action="<?php echo e(route('login')); ?>" method="post" novalidate>
                            <?php echo e(csrf_field()); ?>

                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                <input type="text" class="form-control form-control-lg input-lg" id="user-name" placeholder="Потребител" name="username" required>
                                <div class="form-control-position">
                                    <i class="fa fa-user"></i>
                                </div>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" class="form-control form-control-lg input-lg" id="user-password"name="password" placeholder="Парола" required>
                                <div class="form-control-position">
                                    <i class="fa fa-key"></i>
                                </div>
                            </fieldset>                       
                            <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-unlock" aria-hidden="true"></i>
                            Вход</button>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>