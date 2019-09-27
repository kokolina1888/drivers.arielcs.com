<?php $__env->startSection('title', 'Справка - Оригинал'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-barcode"></i> Справка - "Оригинал"</h4>				
			</div>        
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">	
					<div class="table-responsive">
						<div class="wrapper1">
							<div class="div1"></div>
						</div>
						<div class="wrapper2">
							<div class="div2">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>#</th>
											<th id="order_number">НОМЕР НА<br>ЗАПОВЕД</th>
											<th class="sortable" id="date_created">ДАТА</th>
											<th class="sortable" id="route_list_id">ПЪТЕН ЛИСТ </th>
											<th id="truck_number">МПС<br>/РЕГ.НОМЕР/</th>
											<th>НАЧАЛЕН<br>КИЛОМЕТРАЖ</th>
											<th>КРАЕН<br>КИЛОМЕТРАЖ</th>
											<th id="first_driver">ВОДАЧ 1</th>
											<th id="second_driver">ВОДАЧ 2</th>
											<th class="sortable" id="document_number">ТОВАРИТЕЛНИЦА<br>№ </th>
											<th class="sortable" id="receiver">ТОВАРИТЕЛНИЦА<br>ПОЛУЧАТЕЛ </th>
											<th class="sortable" id="receiver_address">НАСЕЛЕНО МЯСТО<br>/ АДРЕС / </th>
											<th>ВИВЕКТА БГ<br>/ КОЛИЧЕСТВО СТОКА В КГ</th>
											<th>РОСТАР БГ<br>/ КОЛИЧЕСТВО СТОКА В КГ</th>
											<th>ЧУЖД<br>ТРАНСПОРТ/</th>
											<th>ЗАРЕДЕНО<br>ГОРИВО ЛИТРА</th>
											<th>ИЗМИНАТИ<br>КМ</th>
											<th>ЗАБЕЛЕЖКА</th>
											<th>ОБЩО<br>КОЛИЧЕСТВО</th>
											<th>ПОВТОРЕНИЕ</th>																
											<th>МЕЖДУНАРОДЕН</th>																
										</tr>
									</thead>								
									<tbody>									
										<?php if( $documents->count() > 0 ): ?>
										<?php
										$num = 1;
										?>
										<?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><?php echo e($num++); ?></td>
											<?php if( isset($d->route_lists) ): ?>
												<?php if( $d->route_lists->count() == 1 ): ?>											
												<td>												
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if( isset($rl->order_number) ): ?>
														<?php echo e($rl->order_number); ?>

														<?php endif; ?>
														<?php if( isset($rl->order_number2) ): ?>
														, <?php echo e($rl->order_number2); ?>

														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>												
												</td>
												<td><?php echo e($d->date_created); ?></td>
												<td>
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php echo e($rl->route_list_number); ?>

													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</td>
												<td>
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php echo e($rl->truck->number); ?>

													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</td>
												<td>												
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php echo e($rl->km_start); ?>

													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</td>
												<td>												
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php echo e($rl->km_end); ?>

													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>																								
												</td>
												<td>												
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php echo e($rl->first_driver->name); ?>

													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>												
												</td>
												<td>
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if( isset($rl->second_driver->name) ): ?>
														<?php echo e($rl->second_driver->name); ?>

														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>												
												</td>
												<td><?php echo e($d->document_number); ?></td>
												<td><?php echo e($d->receiver); ?></td>
												<td><?php echo e($d->receiver_address); ?></td>
												<td>
													<?php 
														if( (str_contains($d->sender, 'ВИВЕКТА') || str_contains($d->sender, 'Вивекта'))){
															foreach( $d->route_lists as $rl ){
																if( ($rl->is_international == 0)){
																	echo $d->total_weight;
																}
															}
														}
													?>
												</td>
												<td>
													<?php 
													if((str_contains($d->sender, 'РОСТАР') || str_contains($d->sender, 'Ростар'))){
														foreach( $d->route_lists as $rl ){
															if( ($rl->is_international == 0)){
																echo $d->total_weight;
															}
														}
													}
													?>
												</td>
												<td>
													<?php 
														if(!str_contains($d->sender, 'РОСТАР') && !str_contains($d->sender, 'Ростар') && !str_contains($d->sender, 'ВИВЕКТА') && !str_contains($d->sender, 'Вивекта')){													
															foreach( $d->route_lists as $rl ){
															if( ($rl->is_international == 0)){
																echo $d->total_weight;
															}
														}
														}
													?>		
												</td>
												<td>
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php echo e($rl->gas_quant); ?>

													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</td>
												<td>
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php echo e($rl->km_run); ?>

													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</td>
												<td>
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if( isset($rl->note) ): ?>
															<?php echo e($d->route_list->note); ?>

														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</td>
												<td><?php echo e($d->total_weight); ?></td>
												<td></td>														                                    
												<td>
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if( $rl->is_international == 1 ): ?>
															<?php echo e('да'); ?>

														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</td>	
											<?php elseif( $d->route_lists->count() > 1 ): ?>											
												<td>												
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if( isset($rl->order_number) ): ?>
														<?php echo e($rl->order_number); ?>,
														<?php endif; ?>
														<?php if( isset($rl->order_number2) ): ?>
														<?php echo e($rl->order_number2); ?>,
														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>												
												</td>
												<td><?php echo e($d->date_created); ?></td>
												<td>
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php echo e($rl->route_list_number); ?>,
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</td>
												<td>
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php echo e($rl->truck->number); ?>,
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</td>
												<td>												
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php echo e($rl->km_start); ?>,
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</td>
												<td>												
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php echo e($rl->km_end); ?>,
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>																								
												</td>
												<td>												
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php echo e($rl->first_driver->name); ?>,
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>												
												</td>
												<td>
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if( isset($rl->second_driver->name) ): ?>
															<?php echo e($rl->second_driver->name); ?>,
														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>												
												</td>
												<td><?php echo e($d->document_number); ?></td>
												<td><?php echo e($d->receiver); ?></td>
												<td><?php echo e($d->receiver_address); ?></td>
												<td>
													<?php 
														if( (str_contains($d->sender, 'ВИВЕКТА') || str_contains($d->sender, 'Вивекта'))){
															foreach( $d->route_lists as $rl ){
																if( ($rl->is_international == 0)){
																	echo $d->total_weight . ', ';
																}
															}
														}
													?>
												</td>
												<td>
													<?php 
													if((str_contains($d->sender, 'РОСТАР') || str_contains($d->sender, 'Ростар'))){
														foreach( $d->route_lists as $rl ){
															if( ($rl->is_international == 0)){
																echo $d->total_weight. ', ';
															}
														}
													}
													?>
												</td>
												<td>
													
													<?php 
														if(!str_contains($d->sender, 'РОСТАР') && !str_contains($d->sender, 'Ростар') && !str_contains($d->sender, 'ВИВЕКТА') && !str_contains($d->sender, 'Вивекта')){													
															foreach( $d->route_lists as $rl ){
															if( ($rl->is_international == 0)){
																echo $d->total_weight. ', ';
															}
														}
														}
													?>		
													
												</td>
												<td>
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php echo e($rl->gas_quant); ?>,
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</td>
												<td>
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php echo e($rl->km_run); ?>,
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</td>
												<td>
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if( isset($rl->note) ): ?>
															<?php echo e($d->route_list->note); ?>,
														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</td>
												<td><?php echo e($d->total_weight); ?></td>
												<td></td>														                                    
												<td>
													<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php if( $rl->is_international == 1 ): ?>
															да,
														<?php endif; ?>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</td>
											<?php else: ?>
												<td></td>
												<td><?php echo e($d->date_created); ?></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td><?php echo e($d->document_number); ?></td>
												<td><?php echo e($d->receiver); ?></td>
												<td><?php echo e($d->receiver_address); ?></td>
												<td>
													<?php 
														if( (str_contains($d->sender, 'ВИВЕКТА') || str_contains($d->sender, 'Вивекта'))){
															echo $d->total_weight;
														}
													?>
												</td>
												<td>
													<?php 
														if((str_contains($d->sender, 'РОСТАР') || str_contains($d->sender, 'Ростар'))){
															echo $d->total_weight;														
														}
													?>
												</td>
												<td>													
													<?php 
														if(!str_contains($d->sender, 'РОСТАР') && !str_contains($d->sender, 'Ростар') && !str_contains($d->sender, 'ВИВЕКТА') && !str_contains($d->sender, 'Вивекта')){													
															echo $d->total_weight;
														}
													?>														
												</td>
												<td></td>
												<td></td>
												<td></td>
												<td><?php echo e($d->total_weight); ?></td>
												<td></td>														                                    
												<td></td>
											<?php endif; ?>
												<!-- no route lists -->
											
										<?php endif; ?>																					                                   
									</tr>								
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?> 
							<tr>
								<td colspan="20">
									Няма добавени документи с избраните параметри!
								</td>
							</tr>
							<?php endif; ?>								
				</tbody>
			</table>
		</div>																		
	</div>
	<div class="card-block card-dashboard">
		<a href="<?php echo e(route('export_original', ['date_range' => $date_range])); ?>" class="btn btn-info">Експортирай справката</a>
		<a href="<?php echo e(route('reports_original_init')); ?>" class="btn btn-warning">Назад</a>
	</div>	
</div>					
</div>                
</div>
</div>
</div>
</div>
<script type="text/javascript">
	$(".wrapper1").scroll(function(){
		$(".wrapper2").scrollLeft($(".wrapper1").scrollLeft());
	});
	$(".wrapper2").scroll(function(){
		$(".wrapper1").scrollLeft($(".wrapper2").scrollLeft());
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>