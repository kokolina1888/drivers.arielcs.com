<?php $__env->startSection('title', 'Справка - Шофьори - по дни'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-code-branch"></i> Справка - "Шофьори - по дни"</h4>			
				<p><i>офис <b><?php echo e($office_data->name); ?></b></i></p>	
			</div>        
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">
					<table class="table table-bordered">
						<tbody>			
							<?php $__currentLoopData = $data['drivers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr class="driver-header">
									<td> <?php echo e($driver->driver_name); ?> </td>
									<?php $__currentLoopData = $data['days']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<td><?php echo e($day); ?></td>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tr>
								<tr>
									<td>Тонаж <span data-toggle="tooltip" data-placement="top" title="за рамките на София"><i class="fas fa-info-circle"></i></span></td>
									<?php $__currentLoopData = $data['days']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if( isset($data['drivers_to_day'][$driver->id]['total_weight_in_sofia'][$day]) ): ?>
											<td><?php echo e($data['drivers_to_day'][$driver->id]['total_weight_in_sofia'][$day]); ?></td>
										<?php else: ?> 
											<td></td>
										<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tr>
								<tr>
									<td>Брой заявки <span data-toggle="tooltip" data-placement="top" title="за рамките на София"><i class="fas fa-info-circle"></i></span></td>
									<?php $__currentLoopData = $data['days']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>						
										<?php if( isset($data['drivers_to_day'][$driver->id]['num_requests_in_sofia'][$day]) && $data['drivers_to_day'][$driver->id]['num_requests_in_sofia'][$day] != 0 ): ?>
											<td><?php echo e($data['drivers_to_day'][$driver->id]['num_requests_in_sofia'][$day]); ?></td>
										<?php else: ?> 
											<td></td>
										<?php endif; ?>											
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tr>
								<tr>
									<td>Провинция <span data-toggle="tooltip" data-placement="top" title="тонаж"><i class="fas fa-info-circle"></i></span></td>
									<?php $__currentLoopData = $data['days']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>										
										<?php if( isset($data['drivers_to_day'][$driver->id]['total_weight_out_sofia'][$day]) ): ?>
											<td><?php echo e($data['drivers_to_day'][$driver->id]['total_weight_out_sofia'][$day]); ?></td>
										<?php else: ?> 
											<td></td>
										<?php endif; ?>										
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tr>
								<tr>
									<td>Номер на заповед/и <span data-toggle="tooltip" data-placement="top" title="курсове в провинция"><i class="fas fa-info-circle"></i></span></td>
									<?php $__currentLoopData = $data['days']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>																			
										<?php if( isset($data['drivers_to_day'][$driver->id]['order_nums_out_sofia'][$day]) ): ?>										
											<td>
												<?php $__currentLoopData = $data['drivers_to_day'][$driver->id]['order_nums_out_sofia'][$day]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php echo e($order_number->order_number); ?>,
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</td>
										<?php else: ?> 
											<td></td>
										<?php endif; ?>										
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tr>								
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>						
					</table>
				</div>
				<div class="card-block card-dashboard">
					<a href="<?php echo e(route('export_drivers_to_days', ['date_range' => $date_range, 'office'=>$office])); ?>" class="btn btn-info">Експортирай справката</a>
					<a href="<?php echo e(route('reports_drivers_to_days_init')); ?>" class="btn btn-warning">Назад</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>