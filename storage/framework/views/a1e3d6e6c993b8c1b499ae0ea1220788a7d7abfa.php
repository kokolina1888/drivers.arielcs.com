<table">
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