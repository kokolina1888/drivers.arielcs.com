<?php $__env->startSection('title', 'Справка - Международен транспорт'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-drafting-compass"></i> Справка - "Международен транспорт"</h4>		
				<p><i>офис <b><?php echo e($office_data->name); ?></b></i></p>		
			</div>        
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">
					<table class="table table-bordered noname">
						<!-- loop through trucks here -->
						<thead>
							<tr>
								<th>Дата</th>
								<?php $__currentLoopData = $data['document_trucks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<th> <?php echo e($dt[0]->number); ?>-<?php echo e((float)$dt[0]->truck_load); ?>т </th>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<th>
									Общо кг
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$super_sum_totals = 0;
							?>
							<?php $__currentLoopData = $data['documents_dates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td> <?php echo e($date->date_created); ?> </td>
								<?php 
									$doc_date_check = $date->date_created;
									$sum_totals = 0;
								?>
								<?php $__currentLoopData = $data['documents_truck_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $truck_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<td> 
									<?php if( isset($truck_data[$doc_date_check]) ): ?>
										<?php
											$sum_totals += $truck_data[$doc_date_check];
										?>
									<?php endif; ?>
										<?php echo e(isset($truck_data[$doc_date_check]) ? $truck_data[$doc_date_check] : ''); ?>

								</td>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
								<?php 
									$super_sum_totals += $sum_totals;
								?>
								<td>
									<?php echo e($sum_totals); ?>


								</td>							
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
						<tfoot>
							<tr>
								<th>Общо за периода /кг/</th>
								<?php $__currentLoopData = $data['truck_total_weight']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ttw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<th> <?php echo e($ttw); ?> </th>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<th>
									<?php echo e($super_sum_totals); ?>

								</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="card-block card-dashboard">
					<a href="<?php echo e(route('export_international', ['date_range' => $date_range, 'office'=>$office])); ?>" class="btn btn-info">Експортирай справката</a>
					<a href="<?php echo e(route('reports_international_init')); ?>" class="btn btn-warning">Назад</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>