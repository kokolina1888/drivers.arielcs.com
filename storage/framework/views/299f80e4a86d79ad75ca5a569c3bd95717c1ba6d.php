<table>
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
				<th colspan="4">камиони по тонажни категории</th>
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
				