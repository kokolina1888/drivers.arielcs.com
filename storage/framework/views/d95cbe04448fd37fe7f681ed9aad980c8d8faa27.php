<table>
	<?php 
	$drivers = $data['province_drivers_in_sofia'];
	$count = count($drivers);						
	?>
	<?php if($count > 0): ?>
		<?php for( $i = 0; $i < $count; $i+=3 ): ?>
			<tr>
			<?php if( isset($drivers[$i]) ): ?>								
				<th>
					<?php echo e($drivers[$i]['general']['driver_name']); ?>

				</th>
				<th>
					тонаж
				</th>
				<th>
					бр. заявки
				</th>
			<?php endif; ?>
			<?php if( isset($drivers[$i+1]) ): ?>
				<th>
					<?php echo e($drivers[$i+1]['general']['driver_name']); ?>

				</th>
				<th>
					тонаж
				</th>
				<th>
					бр. заявки
				</th>
			<?php endif; ?>	
			<?php if( isset($drivers[$i+2]) ): ?>
				<th>
					<?php echo e($drivers[$i+2]['general']['driver_name']); ?>

				</th>
				<th>
					тонаж
				</th>
				<th>
					бр. заявки
				</th>
			<?php endif; ?>	
			</tr>
			<!-- for j = 0; j= max_rows; j++ -->
			<?php 
				$col_1 = $drivers[$i]['data_in_sofia_per_day']->count();
				if( isset($drivers[$i+1]) ){
					$col_2 = $drivers[$i+1]['data_in_sofia_per_day']->count();
				} else {
					$col_2=0;	
				}
				if( isset($drivers[$i+2]) ){
					$col_3 = $drivers[$i+2]['data_in_sofia_per_day']->count();
				} else {
					$col_3=0;	
				}
				$max_rows = max([$col_1, $col_2, $col_3]);
				echo $max_rows;								
			?>
			
			<?php for($j=0; $j < $max_rows; $j++): ?>
			<tr>
			<?php if( isset($drivers[$i]) ): ?>
				<?php if( isset($drivers[$i]['data_in_sofia_per_day'][$j]) ): ?>	
					<td> <?php echo e($drivers[$i]['data_in_sofia_per_day'][$j]->date_created); ?> </td>
					<td> <?php echo e($drivers[$i]['data_in_sofia_per_day'][$j]->sum_total_weight); ?> </td>
					<td> <?php echo e($drivers[$i]['data_in_sofia_per_day'][$j]->requests); ?> </td>
				<?php else: ?> 
					<td></td>
					<td></td>
					<td></td>
				<?php endif; ?>
			<?php endif; ?>
			<?php if( isset($drivers[$i+1]) ): ?>
				<?php if( isset($drivers[$i+1]['data_in_sofia_per_day'][$j]) ): ?>
					<td> <?php echo e($drivers[$i+1]['data_in_sofia_per_day'][$j]->date_created); ?> </td>
					<td> <?php echo e($drivers[$i+1]['data_in_sofia_per_day'][$j]->sum_total_weight); ?> </td>
					<td> <?php echo e($drivers[$i+1]['data_in_sofia_per_day'][$j]->requests); ?> </td>
				<?php else: ?> 
					<td></td>
					<td></td>
					<td></td>
				<?php endif; ?>
			<?php endif; ?>
			<?php if( isset($drivers[$i+2]) ): ?>
				<?php if( isset($drivers[$i+2]['data_in_sofia_per_day'][$j]) ): ?>
					<td> <?php echo e($drivers[$i+2]['data_in_sofia_per_day'][$j]->date_created); ?> </td>
					<td> <?php echo e($drivers[$i+2]['data_in_sofia_per_day'][$j]->sum_total_weight); ?> </td>
					<td> <?php echo e($drivers[$i+2]['data_in_sofia_per_day'][$j]->requests); ?> </td>
				<?php else: ?> 
					<td></td>
					<td></td>
					<td></td>
				<?php endif; ?>
			<?php endif; ?>
			</tr>
			<?php endfor; ?>
			<tr>
			<?php if( isset($drivers[$i]) ): ?>								
				<th>Общо</th>
				<th><?php echo e($drivers[$i]['total'][0]->sum_total_weight); ?></th>
				<th><?php echo e($drivers[$i]['total'][0]->requests); ?></th>	
			<?php endif; ?>
			<?php if( isset($drivers[$i+1]) ): ?>								
				<th>Общо</th>
				<th><?php echo e($drivers[$i+1]['total'][0]->sum_total_weight); ?></th>
				<th><?php echo e($drivers[$i+1]['total'][0]->requests); ?></th>	
			<?php endif; ?>
			<?php if( isset($drivers[$i+2]) ): ?>								
				<th>Общо</th>
				<th><?php echo e($drivers[$i+2]['total'][0]->sum_total_weight); ?></th>
				<th><?php echo e($drivers[$i+2]['total'][0]->requests); ?></th>	
			<?php endif; ?>
			</tr>
		<?php endfor; ?>
	<?php endif; ?>
</table>