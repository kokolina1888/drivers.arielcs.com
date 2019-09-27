<?php $__env->startSection('title', 'Товарителници - списък'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-clipboard-list"></i> Списък товарителници</h4>
			</div>             

			<?php if(Session::has('success')): ?>
			<div class="card-header">
				<div class="alert bg-success bg-accent-1 row">
					<div class="col-md-8">
						<?php echo e(Session::get('success')); ?> 
					</div>
					<div class="col-md-1 col-md-offset-3">                         
						<div class="col-xs-1 col-xs-offset-11">
							<a href="<?php echo e(route('documents_list', ['order'=>'id', 'direction'=> 'DESC'])); ?>">x</a> 
						</div>                                                                     
					</div>   
				</div>
			</div>
			<?php endif; ?>  
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">								
					<div class="table-responsive">
						<table class="table">							
							<form id="filter-form" method="get" action="<?php echo e(route('documents_list', ['id', 'DESC'])); ?>">
								<thead>
									<tr>
										<th>Филтрирай:</th>
										<th>дата от / до</th>
										<th>МПС /РЕГ.НОМЕР/</th>
										<th>ИМЕ НА ВОДАЧ 1</th>
										<th>ИМЕ НА ВОДАЧ 2</th>				
									</tr>
									<tr>
										<td></td>
										<td><input type="text" name="date" value="<?php if(isset($filters['date'])){ echo $filters['date']; } else { echo $init_date_range; }?>" class="form-control daterange-input"></td>
										<td>
											<select type="text" name="truck" class="form-control">
												<option value="">-- изберете --</option>
												<?php $__currentLoopData = $trucks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($t->id); ?>"
													<?php 
													if(isset($filters['truck'])){
														if( $filters['truck'] == $t->id){
															echo 'selected';
														}
													}
													if( $t->status == 0 ){														
															echo 'class=driver-inactive';														
													}
													?>
													><?php echo e($t->number); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</td>
										<td>
											<select type="text" name="first_driver" class="form-control">
												<option value="">-- изберете --</option>
												<?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($d->id); ?>"
													<?php 
													if(isset($filters['first_driver'])){
														if( $filters['first_driver'] == $d->id){
															echo 'selected';
														}
													}
													if( $d->status == 0 ){														
															echo 'class=driver-inactive';														
													}
													?>
													><?php echo e($d->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</td>
										<td>
											<select type="text" name="second_driver" class="form-control">
												<option value="">-- изберете --</option>
												<?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($d->id); ?>"
													<?php 
													if(isset($filters['second_driver'])){
														if( $filters['second_driver'] == $d->id){
															echo 'selected';
														}
													}
													if( $d->status == 0 ){														
															echo 'class=driver-inactive';														
													}
													?>

													><?php echo e($d->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</td>
									</tr>
									<tr>
										<th></th>
										<th>ЗАПОВЕД No <span data-toggle="tooltip" data-placement="top" title="Започващи с ..."><i class="fas fa-info-circle"></i></span></th>																		
										<th>ТОВАРИТЕЛНИЦА No <span data-toggle="tooltip" data-placement="top" title="Съдържащи..."><i class="fas fa-info-circle"></i></span></th>
										<th>ТОВАРИТЕЛНИЦА ПОЛУЧАТЕЛ <span data-toggle="tooltip" data-placement="top" title="Съдържащи..."><i class="fas fa-info-circle"></i></span></th>								
										<th></th>								
									</tr>
									<tr>
										<td></td>
										<td><input type="text" name="order_number" value="<?php if(isset($filters['order_number'])){ echo $filters['order_number']; }?>" class="form-control"></td>
										<td><input type="text" name="document" value="<?php if(isset($filters['document'])){ echo $filters['document']; }?>" class="form-control"></td>
										<td><input type="text" name="receiver" value="<?php if(isset($filters['receiver'])){ echo $filters['receiver']; }?>" class="form-control"></td>	
										<td>
											<button type="submit" class="btn btn-primary">Приложи</button>
											<a href="<?php echo e(route('documents_list', ['order'=>'id', 'direction' => 'DESC'])); ?>" class="btn btn-warning">Изчисти</a>
										</td>
									</tr>
								</thead>
							</form>
						</table>
					</div>
				</div>
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
										<th class="sortable" id="on" >НОМЕР НА<br>ЗАПОВЕД <i class="<?php echo e($arrow_class); ?>"></i></th>
										<th class="sortable" id="dc">ДАТА <i class="<?php echo e($arrow_class); ?>"></i></a></th>
										<th class="sortable" id="rl">ПЪТЕН ЛИСТ <i class="<?php echo e($arrow_class); ?>"></i></th>
										<th class="sortable" id="tn">МПС<br>/РЕГ.НОМЕР/ <i class="<?php echo e($arrow_class); ?>"></i></th>
										<th>НАЧАЛЕН<br>КИЛОМЕТРАЖ</th>
										<th>КРАЕН<br>КИЛОМЕТРАЖ</th>
										<th class="sortable" id="fd">ВОДАЧ 1 <i class="<?php echo e($arrow_class); ?>"></i></th>
										<th class="sortable" id="sd">ВОДАЧ 2 <i class="<?php echo e($arrow_class); ?>"></i></th>
										<th class="sortable" id="dn">ТОВАРИТЕЛНИЦА<br>№ <i class="<?php echo e($arrow_class); ?>"></i></th>
										<th class="sortable" id="r">ТОВАРИТЕЛНИЦА<br>ПОЛУЧАТЕЛ <i class="<?php echo e($arrow_class); ?>"></i></th>
										<th class="sortable" id="ra">НАСЕЛЕНО МЯСТО<br>/ АДРЕС / <i class="<?php echo e($arrow_class); ?>"></i></th>
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
										if( isset($_GET['page']) ){
											$num = ($_GET['page']-1)*$per_page+1;
										} else {
											$num = 1;
										}
										?>
										<?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo e($num); ?></td>	
												<?php
													$num++;
												?>	
												<td>													
													<?php if( isset($d->route_lists) ): ?>
														<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<?php if( isset($rl->order_number) ): ?>
																<?php echo e($rl->order_number); ?>,															
															<?php endif; ?>	
															<?php if( isset($rl->order_number2) ): ?>
																<?php echo e($rl->order_number2); ?>,
															<?php endif; ?>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>															
													<?php endif; ?>
												</td>
												<td><?php echo e($d->date_created); ?></td>
												<td><?php if( isset($d->route_lists) ): ?>
														<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<?php echo e($rl->route_list_number); ?> 
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<?php endif; ?>
												</td>
												<td><?php if( isset($d->route_lists) ): ?>
														<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>														
															<?php echo e($rl->truck->number); ?> 
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<?php endif; ?>
												</td>
												<td>
													<?php if( isset($d->route_lists) ): ?>
														<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>														
															<?php echo e($rl->km_start); ?> 
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<?php endif; ?>
												</td>
												<td>
													<?php if( isset($d->route_lists) ): ?>
														<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>														
															<?php echo e($rl->km_end); ?> 
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<?php endif; ?>
												</td>
												<td>
													<?php if( isset($d->route_lists) ): ?>
														<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>														
															<?php echo e($rl->first_driver->name); ?> 
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<?php endif; ?>
												</td>												
												<td>
													<?php if( isset($d->route_lists) ): ?>
														<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<?php if( isset($rl->second_driver->name) ): ?>
																<?php echo e($rl->second_driver->name); ?>

															<?php endif; ?>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													 <?php endif; ?>
												</td>

												<td><?php echo e($d->document_number); ?></td>
												<td><?php echo e($d->receiver); ?></td>
												<td><?php echo e($d->receiver_address); ?></td>
												<td>
												<?php if( isset($d->route_list) ): ?>
												<?php 
													if( (str_contains($d->sender, 'ВИВЕКТА') || str_contains($d->sender, 'Вивекта')) && ($d->route_list->is_international == 0) ){
														echo $d->total_weight;
													}
												?>
												<?php else: ?> 
													<?php
													if( (str_contains($d->sender, 'ВИВЕКТА') || str_contains($d->sender, 'Вивекта'))){
														echo $d->total_weight;
													}
													?>
												<?php endif; ?>
												</td>
												<td>
												<?php if( isset($d->route_list) ): ?>
												<?php 
													if((str_contains($d->sender, 'РОСТАР') || str_contains($d->sender, 'Ростар')) && ($d->route_list->is_international == 0)){
														echo $d->total_weight;
													}
												?>
												<?php else: ?> 
												<?php 
													if((str_contains($d->sender, 'РОСТАР') || str_contains($d->sender, 'Ростар'))){
														echo $d->total_weight;
													}
												?>
												<?php endif; ?>
												</td>
												<td>
												<?php 
												if(!str_contains($d->sender, 'РОСТАР') && !str_contains($d->sender, 'Ростар') && !str_contains($d->sender, 'ВИВЕКТА') && !str_contains($d->sender, 'Вивекта')){													
															echo $d->total_weight;
														}
													?>	
												</td>
												<td><?php echo e($d->gas_quant); ?></td>
												<td><?php echo e($d->km_run); ?></td>
												<td><?php if( isset($d->route_list) ): ?><?php echo e($d->route_list->note); ?><?php endif; ?></td>
												<td><?php echo e($d->total_weight); ?></td>
												<td>													
													<?php if( isset($d->route_lists) ): ?>
														<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<?php if( $rl->pivot->is_repeated ): ?>
																повторение
															<?php endif; ?>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<?php endif; ?>
												</td>														                                    
												<td>
													<?php if( isset($d->route_lists) ): ?>
														<?php $__currentLoopData = $d->route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<?php if( $rl->is_international == 1 ): ?>
																<?php echo e('да'); ?>

															<?php endif; ?>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													<?php endif; ?>
												</td>														                                    
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
					</div>
					<?php echo e($documents->links()); ?>

				</div>                
			</div>
		</div>
	</div>
</div>
	<script type="text/javascript">
						var token = "<?php echo e(Session::token()); ?>";   
						var host = "<?php echo e(URL::to('/')); ?>"; 
						$.ajaxSetup({
							headers: {
								'X-CSRF-TOKEN': token
							}
						});
						$(function(){
  $(".wrapper1").scroll(function(){
    $(".wrapper2").scrollLeft($(".wrapper1").scrollLeft());
  });
  $(".wrapper2").scroll(function(){
    $(".wrapper1").scrollLeft($(".wrapper2").scrollLeft());
  });
	});
	$(function() {           
		$('input[name="date"]').daterangepicker({
			locale: {
				"format": "DD/MM/YYYY",
				"applyLabel": "Избери",
				"cancelLabel": "Откажи",
				"daysOfWeek": [
				"Нед",
				"Пон",
				"Вт",
				"Ср",
				"Четв",
				"Пет",
				"Съб"
				],
				"monthNames": [
				"Януари",
				"Февруари",
				"Март",
				"Април",
				"Май",
				"Юни",
				"Юли",
				"Август",
				"Септември",
				"Октомври",
				"Ноември",
				"Декември"
				]},
				opens: 'top',
				inline: true,
				useCurrent: true								
			}, function(start, end, label) {
				// console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
			});
		});

		var sorted = "<?php echo e($sorted); ?>";
		$('#'+sorted + ' i').css({display: 'block'});
		$('#'+sorted ).css({ background: '#F1EFEF'});

		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})					

	$('.sortable').on('click', function(){
		var filters = {};
		filters.date = $('input[name="date"]').val();
		filters.truck = $('select[name="truck"]').val();
		filters.first_driver = $('select[name="first_driver"]').val();
		filters.second_driver = $('select[name="second_driver"]').val();
		filters.order_number = $('input[name="order_number"]').val();		
		filters.document = $('input[name="document"]').val();
		filters.receiver = $('input[name="receiver"]').val();		

		if ($(this).find('i').attr('class') == 'fas fa-angle-down') {
			var order = $(this).attr('id'),
			direction = 'ASC', queryStr;
			queryStr = host+'/documents-list/'+ order + '/' + direction + '?date=' + filters.date + '&document=' + filters.document + '&receiver=' + filters.receiver + '&order_number='+filters.order_number;
			if(filters.first_driver != 'undefined'){
				queryStr+='&first_driver='+filters.first_driver;
				// alert(filters.first_driver);
			} else {
				queryStr+='&first_driver=';
				// alert(filters.first_driver);
			}
			if(filters.second_driver != 'undefined'){
				queryStr+='&second_driver='+filters.second_driver;
			} else {
				queryStr+='&second_driver=';				
			}
			if(filters.truck != 'undefined'){
				queryStr+='&truck='+filters.truck;
			} else {
				queryStr+='&truck=';				
			}
			// console.log((filters.first_driver != 'indefined'))
			window.location.href = queryStr;
		}
		if ($(this).find('i').attr('class') == 'fas fa-angle-up') {
			var order = $(this).attr('id'),
			direction = 'DESC';
			queryStr = host+'/documents-list/'+ order + '/' + direction + '?date=' + filters.date + '&document=' + filters.document + '&receiver=' + filters.receiver + '&order_number='+filters.order_number;
			if(filters.first_driver != 'undefined'){
				queryStr+='&first_driver='+filters.first_driver;
				// alert(filters.first_driver);
			} else {
				queryStr+='&first_driver=';
				// alert(filters.first_driver);
			}
			if(filters.second_driver != 'undefined'){
				queryStr+='&second_driver='+filters.second_driver;
			} else {
				queryStr+='&second_driver=';				
			}
			if(filters.truck != 'undefined'){
				queryStr+='&truck='+filters.truck;
			} else {
				queryStr+='&truck=';				
			}
			// console.log((filters.first_driver != 'undefined'))
			window.location.href = queryStr;
		}
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>