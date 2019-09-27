<table>
	<tbody>			
		<?php $__currentLoopData = $data['drivers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<th> <?php echo e($driver->driver_name); ?> </th>
			<?php $__currentLoopData = $data['days']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<th><?php echo e($day); ?></th>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<tr>
			<td>Тонаж</td>
			<?php $__currentLoopData = $data['days']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if( isset($data['drivers_to_day'][$driver->id]['total_weight_in_sofia'][$day]) ): ?>
					<td><?php echo e($data['drivers_to_day'][$driver->id]['total_weight_in_sofia'][$day]); ?></td>
				<?php else: ?> 
					<td></td>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<tr>
			<td>Брой заявки</td>
			<?php $__currentLoopData = $data['days']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>						
				<?php if( isset($data['drivers_to_day'][$driver->id]['num_requests_in_sofia'][$day]) && $data['drivers_to_day'][$driver->id]['num_requests_in_sofia'][$day] != 0 ): ?>
				<td><?php echo e($data['drivers_to_day'][$driver->id]['num_requests_in_sofia'][$day]); ?></td>
				<?php else: ?> 
					<td></td>
				<?php endif; ?>											
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<tr>
			<td>Провинция</td>
			<?php $__currentLoopData = $data['days']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>										
				<?php if( isset($data['drivers_to_day'][$driver->id]['total_weight_out_sofia'][$day]) ): ?>
					<td><?php echo e($data['drivers_to_day'][$driver->id]['total_weight_out_sofia'][$day]); ?></td>
				<?php else: ?> 
					<td></td>
				<?php endif; ?>										
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tr>
		<tr>
			<td>Номер на заповед/и</td>
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
				