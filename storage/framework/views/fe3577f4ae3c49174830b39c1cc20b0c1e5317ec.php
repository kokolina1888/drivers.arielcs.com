<?php $__env->startSection('title', 'Пътни листове - списък'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-list-ul"></i> Списък пътни листове</h4>
			</div>             
			<?php if(Session::has('success')): ?>
			<div class="card-header">
				<div class="alert bg-success bg-accent-1 row">
					<div class="col-md-8">
						<?php echo e(Session::get('success')); ?> 
					</div>
					<div class="col-md-1 col-md-offset-3">                         
						<div class="col-xs-1 col-xs-offset-11">
							<a href="<?php echo e(route('route_lists_list', ['order'=>'id', 'direction'=> 'DESC'])); ?>">x</a> 
						</div>                                                                     
					</div>   
				</div>
			</div>
			<?php endif; ?>  
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">
					<div class="table-responsive">
						<table class="table">							
							<form id="filter-form" method="get" action="<?php echo e(route('route_lists_list', ['id', 'DESC'])); ?>">
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
										<td><input type="text" name="date" id="filter-date" value="<?php if(isset($filters['date'])){ echo $filters['date']; } else { echo $init_date_range; }?>" class="form-control daterange-input"></td>
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
										<th></th>
										<th></th>								
										<th></th>								
									</tr>
									<tr>
										<td></td>
										<td><input type="text" name="order_number" value="<?php if(isset($filters['order_number'])){ echo $filters['order_number']; }?>" class="form-control"></td>
										<td></td>
										<td></td>	
										<td>
											<button type="submit" class="btn btn-primary">Приложи</button>
											<a href="<?php echo e(route('route_lists_list', ['order'=>'id', 'direction' => 'DESC'])); ?>" class="btn btn-warning">Изчисти</a>
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
							<table class="table table-bordered">
								<thead>
									<tr>										
										<th>#</th>
										<th>***</th>
										<th>***</th>
										<th class="sortable" id="on">НОМЕР НА<br>ЗАПОВЕД <i class="<?php echo e($arrow_class); ?>"></i></th>
										<th class="sortable" id="rl">ПЪТЕН ЛИСТ <i class="<?php echo e($arrow_class); ?>"></i></th>
										<th class="sortable" id="tn">МПС<br>/РЕГ.НОМЕР/ <i class="<?php echo e($arrow_class); ?>"></i></th>
										<th>НАЧАЛЕН<br>КИЛОМЕТРАЖ</th>
										<th>КРАЕН<br>КИЛОМЕТРАЖ</th>
										<th class="sortable" id="fd">ВОДАЧ 1 <i class="<?php echo e($arrow_class); ?>"></i></th>
										<th class="sortable" id="sd">ВОДАЧ 2 <i class="<?php echo e($arrow_class); ?>"></i></th>
										<th>ЗАРЕДЕНО<br>ГОРИВО ЛИТРА</th>
										<th>ИЗМИНАТИ<br>КМ</th>
										<th>ЗАБЕЛЕЖКА</th>		
										<th>МЕЖДУНАРОДЕН</th>		
										<th></th>														
									</tr>
								</thead>								
								<tbody>									
									<?php if( $route_lists->count() > 0 ): ?>
										<?php
										if( isset($_GET['page']) ){
											$num = ($_GET['page']-1)*$per_page+1;
											$page = $_GET['page'];
										} else {
											$num = 1;
											$page = 1;
										}
										?>
										
										<?php $__currentLoopData = $route_lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo e($num++); ?></td>
												<?php if( $rl->is_handentered == 0 ): ?>
												<?php if( isset($rl->second_driver) ): ?>
												<td>
													<?php if($rl->first_driver->status ): ?>
														<?php if( $rl->second_driver ): ?>
															<?php if( $rl->truck->status ): ?>
													<form action="<?php echo e(route('route_list_edit', $rl->id)); ?>" method="post">
														<?php echo e(csrf_field()); ?>

														<input type="hidden" name="edit" value="<?php echo e($filters['date']?? $init_date_range); ?>">
														<input type="hidden" name="truck" value="<?php echo e($filters['truck']??''); ?>">
														<input type="hidden" name="first_driver" value="<?php echo e($filters['first_driver']??''); ?>">
														<input type="hidden" name="second_driver" value="<?php echo e($filters['second_driver']??''); ?>">
														<input type="hidden" name="order_number" value="<?php echo e($filters['order_number']??''); ?>">
														<input type="hidden" name="sorted" value="<?php echo e($sorted); ?>">
														<input type="hidden" name="direction" value="<?php echo e($direction); ?>">
														<input type="hidden" name="page" value="<?php echo e($page); ?>">
														<button type="submit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="Редактирай!">
																<i class="far fa-edit"></i>
														</button>
													</form>
															<?php endif; ?>
														<?php endif; ?>
													<?php endif; ?>
												</td>
												<?php else: ?>
												<td>
													<?php if($rl->first_driver->status ): ?>														
														<?php if( $rl->truck->status ): ?>
													<form action="<?php echo e(route('route_list_edit', $rl->id)); ?>" method="post">
														<?php echo e(csrf_field()); ?>

														<input type="hidden" name="edit" value="<?php echo e($filters['date']?? $init_date_range); ?>">
														<input type="hidden" name="truck" value="<?php echo e($filters['truck']??''); ?>">
														<input type="hidden" name="first_driver" value="<?php echo e($filters['first_driver']??''); ?>">
														<input type="hidden" name="second_driver" value="<?php echo e($filters['second_driver']??''); ?>">
														<input type="hidden" name="order_number" value="<?php echo e($filters['order_number']??''); ?>">
														<input type="hidden" name="sorted" value="<?php echo e($sorted); ?>">
														<input type="hidden" name="direction" value="<?php echo e($direction); ?>">
														<input type="hidden" name="page" value="<?php echo e($page); ?>">
														<button type="submit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="Редактирай!">
																<i class="far fa-edit"></i>
														</button>
													</form>															
														<?php endif; ?>
													<?php endif; ?>
												</td>
												<?php endif; ?>
												<td>
													<form action="<?php echo e(route('route_list_destroy', $rl->id)); ?>" method="post">
														<?php echo e(csrf_field()); ?>

														<input type="hidden" name="delete_date" value="<?php echo e($filters['date']?? $init_date_range); ?>">
														<input type="hidden" name="truck" value="<?php echo e($filters['truck']??''); ?>">
														<input type="hidden" name="first_driver" value="<?php echo e($filters['first_driver']??''); ?>">
														<input type="hidden" name="second_driver" value="<?php echo e($filters['second_driver']??''); ?>">
														<input type="hidden" name="order_number" value="<?php echo e($filters['order_number']??''); ?>">
														<input type="hidden" name="sorted" value="<?php echo e($sorted); ?>">
														<input type="hidden" name="direction" value="<?php echo e($direction); ?>">
														<input type="hidden" name="page" value="<?php echo e($page); ?>">
														<button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Изтрий! Прикачените товарителници остават неасоциирани с пътен лист.">
																<i class="fa fa-times" aria-hidden="true"></i>
														</button>
													</form>											
												</td>
												
												<?php elseif( $rl->is_handentered == 1 ): ?>
												<?php if( isset($rl->second_driver) ): ?>
												<td>
													<?php if( $rl->first_driver->status ): ?> 
														<?php if( $rl->truck->status ): ?>
															<?php if( $rl->second_driver->status ): ?>
														<form action="<?php echo e(route('edit_handentered_data', $rl->id)); ?>" method="post">
														<?php echo e(csrf_field()); ?>

														<input type="hidden" name="edit_date" value="<?php if(isset($filters['date'])){ echo $filters['date']; } else { echo $init_date_range; }?>">
														<input type="hidden" name="truck" value="<?php echo e($filters['truck']??''); ?>">
														<input type="hidden" name="first_driver" value="<?php echo e($filters['first_driver']??''); ?>">
														<input type="hidden" name="second_driver" value="<?php echo e($filters['second_driver']??''); ?>">
														<input type="hidden" name="order_number" value="<?php echo e($filters['order_number']??''); ?>">
														<input type="hidden" name="sorted" value="<?php echo e($sorted); ?>">
														<input type="hidden" name="page" value="<?php echo e($page); ?>">
														<input type="hidden" name="direction" value="<?php echo e($direction); ?>">
														<input type="hidden" name="path" value="<?php echo e(Route::currentRouteName()); ?>">
														<button type="submit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="Редактирай! Прикачените товарителници остават неасоциирани с пътен лист.">
																<i class="far fa-edit"></i>
														</button>
													</form>
															<?php endif; ?>
														<?php endif; ?>
													<?php endif; ?>
												</td>
												<?php else: ?> 
												<td>
													<?php if( $rl->first_driver->status ): ?> 
														<?php if( $rl->truck->status ): ?>
														<form action="<?php echo e(route('edit_handentered_data', $rl->id)); ?>" method="post">
														<?php echo e(csrf_field()); ?>

														<input type="hidden" name="edit_date" value="<?php if(isset($filters['date'])){ echo $filters['date']; } else { echo $init_date_range; }?>">
														<input type="hidden" name="truck" value="<?php echo e($filters['truck']??''); ?>">
														<input type="hidden" name="first_driver" value="<?php echo e($filters['first_driver']??''); ?>">
														<input type="hidden" name="second_driver" value="<?php echo e($filters['second_driver']??''); ?>">
														<input type="hidden" name="order_number" value="<?php echo e($filters['order_number']??''); ?>">
														<input type="hidden" name="sorted" value="<?php echo e($sorted); ?>">
														<input type="hidden" name="page" value="<?php echo e($page); ?>">
														<input type="hidden" name="direction" value="<?php echo e($direction); ?>">
														<input type="hidden" name="path" value="<?php echo e(Route::currentRouteName()); ?>">
														<button type="submit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="Редактирай! Прикачените товарителници остават неасоциирани с пътен лист.">
																<i class="far fa-edit"></i>
														</button>
													</form>
															
														<?php endif; ?>
													<?php endif; ?>
												</td>

												<?php endif; ?>
												
												<td>

													<form action="<?php echo e(route('destroy_handentered_data', $rl->id)); ?>" method="post">
														<?php echo e(csrf_field()); ?>

														<input type="hidden" name="date" value="<?php if(isset($filters['date'])){ echo $filters['date']; } else { echo $init_date_range; }?>">
														<input type="hidden" name="truck" value="<?php echo e($filters['truck']??''); ?>">
														<input type="hidden" name="first_driver" value="<?php echo e($filters['first_driver']??''); ?>">
														<input type="hidden" name="second_driver" value="<?php echo e($filters['second_driver']??''); ?>">
														<input type="hidden" name="order_number" value="<?php echo e($filters['order_number']??''); ?>">
														<input type="hidden" name="sorted" value="<?php echo e($sorted); ?>">
														<input type="hidden" name="direction" value="<?php echo e($direction); ?>">
														<button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Изтрий! Прикачените товарителници остават неасоциирани с пътен лист.">
																<i class="fa fa-times" aria-hidden="true"></i>
														</button>
													</form>											
												</td>
												<?php endif; ?>	
												<td>
													<?php echo e($rl->order_number); ?><?php if(!is_null($rl->order_number2) && ($rl->order_number2 != 0) ): ?>, <?php echo e($rl->order_number2); ?>

													<?php endif; ?>												
												</td>
												<td><?php echo e($rl->route_list_number); ?></td>
												<td><?php echo e($rl->truck->number); ?></td>
												<td><?php echo e($rl->km_start); ?></td>
												<td><?php echo e($rl->km_end); ?></td>
												<td><?php echo e($rl->first_driver->name); ?></td>
												<td>
													<?php if( isset($rl->second_driver->name) ): ?>
													<?php echo e($rl->second_driver->name); ?>

													<?php endif; ?>
												</td>
												<td><?php echo e($rl->gas_quant); ?></td>
												<td><?php echo e($rl->km_run); ?></td>
												<td><?php echo e($rl->note); ?></td>                
												<td>
													<?php if( $rl->is_international == 1 ): ?>
														<?php echo e('да'); ?>

													<?php endif; ?>
												</td>
												<td>
													<a href="#" id="rl-<?php echo e($rl->id); ?>" class="display-tov-list">
														<i class="fas fa-arrow-left"></i>
														<!-- on click - view attached documents, arrow-down -->
													</a>
												</td>														                                    
											</tr>
											<?php if( $rl->documents->count() > 0): ?>
												<?php $num_list=1 ?>
												<tr class="rl-<?php echo e($rl->id); ?> rl-list-hidden" style="background-color: #ccc;">
														<td colspan="3"></td>
														<td>#</td>
														<td class="text-center font-weight-bold">
															дата
														</td>
														<td class="text-center font-weight-bold">
															No товарителница
														</td>
														<td class="text-center font-weight-bold">
															общо тегло
														</td>
														<td colspan="2" class="text-center font-weight-bold">
															изпращач
														</td>
														<td colspan="2" class="text-center font-weight-bold">
															получател
														</td>
														<td colspan="3" class="text-center font-weight-bold">
															адрес - получател
														</td>
													</tr>
												<?php $__currentLoopData = $rl->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

													<tr class="rl-<?php echo e($rl->id); ?> rl-list-hidden" style="background-color: #ccc;">
														<td colspan="3"></td>
														<td><?php echo e($num_list++); ?></td>
														<td>
															<?php echo e($d->date_created); ?>

														</td>
														<td>
															<?php echo e($d->document_number); ?>

														</td>
														<td>
															<?php echo e($d->total_weight); ?>

														</td>
														<td colspan="2">
															<?php echo e($d->sender); ?>

														</td>
														<td colspan="2">
															<?php echo e($d->receiver); ?>

														</td>
														<td colspan="3">
															<?php echo e($d->receiver_address); ?>

														</td>
													</tr>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
												<?php $num_list=1 ?>
											<?php else: ?> 
												<tr class="rl-<?php echo e($rl->id); ?> rl-list-hidden bg-warning text-center">
													<td colspan="14">
														Няма товарителници към този пътен лист!
													</td>
												</tr>
											<?php endif; ?>							
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
					<?php echo e($route_lists->links()); ?>

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
		filters.truck = $('input[name="truck"]').val();
		filters.first_driver = $('select[name="first_driver"]').val();
		filters.second_driver = $('select[name="second_driver"]').val();
		filters.order_number = $('input[name="order_number"]').val();	

		if ($(this).find('i').attr('class') == 'fas fa-angle-down') {
			var order = $(this).attr('id'),			
			direction = 'ASC';
			console.log(order);

			queryStr = host+'/route-lists-list/'+ order + '/' + direction + '?date=' + filters.date + '&order_number=' + filters.order_number;
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
			console.log(order);

			queryStr = host+'/route-lists-list/'+ order + '/' + direction + '?date=' + filters.date + '&order_number=' + filters.order_number;
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
	});

	$('.display-tov-list').on('click', function(e){
		e.preventDefault();
		if( $(this).children('i').attr('class') == 'fas fa-arrow-left'){
			$(this).children('i').removeClass('fa-arrow-left')
				.addClass('fa-arrow-down');
			let ident = $(this).attr('id');			
			$('.' + ident).removeClass('rl-list-hidden');
		} else if( $(this).children('i').attr('class') == 'fas fa-arrow-down' ){
			$(this).children('i').removeClass('fa-arrow-down')
				.addClass('fa-arrow-left');
			let ident = $(this).attr('id');
			$('.' + ident).addClass('rl-list-hidden')
		}
		
	});


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>