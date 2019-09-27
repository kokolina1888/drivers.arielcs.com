<?php $__env->startSection('title', 'Справка - Шофьори - сумарна за период'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-chess"></i> Справка - "Шофьори - сумарна за период"</h4>
				<p><i>офис <b><?php echo e($office->name); ?></b></i></p>				
			</div>        
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Офис - <?php echo e($office->name); ?></th>
								<th>неделни</th>
								<th>ремарке</th>
								<th>КОМАНДИРОВКИ - брой</th>
								<?php $__currentLoopData = $data['trucks_by_weight_category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $twc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<th><?php echo e($twc->name); ?></th>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<th>ТОНАЖ - СОФИЯ</th>
								<th>БРОЙ ЗАЯВКИ - СОФИЯ</th>
								<th>ОБЩО</th>
								<th>ПОДПИС</th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $data['drivers_for_period']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($driver['general']['driver_name']); ?></td>
								<td></td>
								<td></td>
								<td><?php echo e($driver['num_order_numbers']); ?></td>
								<?php $__currentLoopData = $data['trucks_by_weight_category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $twc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<td><?php echo e($driver['num_order_numbers_per_truck_weight_category'][$twc->id]); ?></td>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<td><?php echo e($driver['total_weight_in_sofia']); ?></td>
								<td><?php echo e($driver['num_requests_in_sofia']); ?></td>
								<td></td>
								<td></td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>							
						</tbody>		
						<tfoot>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<?php $__currentLoopData = $data['trucks_by_weight_category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $twc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<td></td>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<?php for( $i = 0; $i < $data['trucks_weight_category_max_trucks']; $i++ ): ?>
								<tr>
									<?php if( $i == 0 ): ?>
									<th colspan="4" class="text-right">камиони по тонажни категории</th>
									<?php else: ?>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<?php endif; ?>
									<?php $__currentLoopData = $data['trucks_by_weight_category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $twc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<td>
											<?php if( isset($twc->trucks[$i])): ?>
												<?php echo e($twc->trucks[$i]->number); ?>

											<?php endif; ?>
										</td>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							<?php endfor; ?>
						</tfoot>	
					</table>
				</div>
				<div class="card-block card-dashboard">
					<a href="<?php echo e(route('export_drivers_for_period', ['date_range' => $date_range, 'office'=>$office->id])); ?>" class="btn btn-info">Експортирай справката</a>
					<a href="<?php echo e(route('reports_drivers_for_period_init')); ?>" class="btn btn-warning">Назад</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>