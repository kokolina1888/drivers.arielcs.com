<?php $__env->startSection('title', 'Потребители - списък'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Потребители</h4>
			</div>             
			<?php if(Session::has('success')): ?>
			<div class="card-header">
				<div class="alert bg-success bg-accent-1 row">
					<div class="col-md-8">
						<?php echo e(Session::get('success')); ?> 
					</div>
					<div class="col-md-1 col-md-offset-3">                         
						<div class="col-xs-1 col-xs-offset-11">
							<a href="<?php echo e(route('users_list')); ?>">x</a> 
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
										<th class="col-xs-1">#</th>
										<th class="col-xs-5">Име</th>
										<th class="col-xs-1">Роля</th>
										<th class="col-xs-1"></th>
									</tr>
								</thead>								
								<tbody>
									<?php if( !$users->isEmpty() ): ?>
										<?php
										$num = 1;
										?>
										<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<th scope="row"><?php echo e($num++); ?></th>
											<td><?php echo e($u->username); ?></td>
											<td><?php echo e($u->role); ?></td>
											<?php if( $u->role != 'admin'): ?>
											<td><a href="<?php echo e(route('users_edit', $u->id )); ?>" class="btn btn-warning mr-1 mb-1" data-toggle="tooltip" 	data-placement="left" title="Редактирай"><i class="far fa-edit"></i></a></td>											
											<td>
												<form action="<?php echo e(route('users_destroy', $u->id)); ?>" method="post">
												<?php echo e(csrf_field()); ?>

													<button type="submit" class="btn btn-danger mr-1 mb-1" data-toggle="tooltip" data-placement="left" title="Изтрий"><i class="fa fa-times" aria-hidden="true"></i>
													</button>
												</form>											
											</td>
											<?php endif; ?>                                    
										</tr>								
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php else: ?> 
										<tr>
											<td colspan="4">
												Няма добавени потребители!
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