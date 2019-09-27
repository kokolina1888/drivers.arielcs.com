<?php $__env->startSection('title', 'Офиси - списък'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-igloo"></i> СПИСЪК Офиси</h4>
			</div>             
			<?php if(Session::has('success')): ?>
			<div class="card-header">
				<div class="alert bg-success bg-accent-1 row">
					<div class="col-md-8">
						<?php echo e(Session::get('success')); ?> 
					</div>
					<div class="col-md-1 col-md-offset-3">                         
						<div class="col-xs-1 col-xs-offset-11">
							<a href="<?php echo e(route('offices_list')); ?>">x</a> 
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
							<a href="<?php echo e(route('offices_list')); ?>">x</a> 
						</div>                                                                     
					</div>   
				</div>
			</div>
			<?php endif; ?>  
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">                    
					<div class="table-responsive">
						<div class="col-xs-8">
							<table class="table col-xs-8">
								<thead>
									<tr>
										<th class="col-xs-1  text-center">#</th>
										<th class="col-xs-5 text-center">Офис</th>										
										<?php if( Auth::user()->role == 'admin'): ?>
										<th class="col-xs-1 text-center">***</th>
										<th class="col-xs-1 text-center">***</th>
										<?php endif; ?>
									</tr>
								</thead>								
								<tbody>
									<?php if( !$offices->isEmpty() ): ?>
										<?php
										$num = 1;
										?>
										<?php $__currentLoopData = $offices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td scope="row" class="text-center"><?php echo e($num++); ?></th>
											<td class="text-center"><?php echo e($o->name); ?></td>
											
											<?php if( Auth::user()->role == 'admin' && $o->id != 1 ): ?>
											<td class="text-center"><a href="<?php echo e(route('offices_edit', $o->id )); ?>" class="btn btn-warning mr-1 mb-1" data-toggle="tooltip" 	data-placement="left" title="Редактирай"><i class="far fa-edit"></i></a></td>
											<td class="text-center">
												<form action="<?php echo e(route('offices_destroy', $o->id)); ?>" method="post">
												<?php echo e(csrf_field()); ?>

													<button type="submit" class="btn btn-danger mr-1 mb-1" data-toggle="tooltip" data-placement="left" title="Изтрий! Няма да бъде изтрит ако е добавен към водач!"><i class="fa fa-times" aria-hidden="true"></i>
													</button>
												</form>											
											</td>
											<?php endif; ?>                                    
										</tr>								
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php else: ?> 
										<tr>
											<td colspan="4">
												Няма добавени офиси!
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
</div>
<script type="text/javascript">
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>