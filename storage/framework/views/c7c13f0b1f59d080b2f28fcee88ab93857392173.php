<?php $__env->startSection('title', 'Файлове справки - списък'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-warehouse"></i> Списък файлове - справки</h4>
			</div>   
			<?php if(Session::has('success')): ?>
			<div class="card-header">
				<div class="alert bg-success bg-accent-1 row">
					<div class="col-md-8">
						<?php echo e(Session::get('success')); ?> 
					</div>
					<div class="col-md-1 col-md-offset-3">                         
						<div class="col-xs-1 col-xs-offset-11">
							<a href="<?php echo e(route('sales_data_file_list', ['order'=>'id', 'direction'=> 'DESC'])); ?>">x</a> 
						</div>                                                                     
					</div>   
				</div>
			</div>
			<?php endif; ?>  
			<?php if(Session::has('warning')): ?>
			<div class="card-header">
				<div class="alert bg-warning bg-accent-1 row">
					<div class="col-md-10">
						<?php echo e(Session::get('warning')); ?> 
					</div>
					<div class="col-md-1 col-md-offset-1">                         
						<div class="col-xs-1 col-xs-offset-11">
							<a href="<?php echo e(route('sales_data_file_list', ['order'=>'id', 'direction'=> 'DESC'])); ?>">x</a> 
						</div>                                                                     
					</div>   
				</div>
			</div>
			<?php endif; ?>  
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">								
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Филтрирай:</th>
									<th>дата от / до</th>										
									<th>име на файл</th>	
									<th></th>
									<th></th>
								</tr>
								<tr>
									<form id="filter-form" method="get" action="<?php echo e(route('sales_data_file_list', ['id', 'DESC'])); ?>">
										<td></td>
										<td><input type="text" placeholder="от ДД/ММ/ГГГГ - до ДД/ММ/ГГГГ" name="date" value="<?php if(isset($filters['date'])){ echo $filters['date']; } else { echo $init_date_range; }?>" class="form-control daterange-input">
										</td>
										<td><input type="text" name="filename" value="<?php if(isset($filters['filename'])){ echo $_GET['filename']; }?>" class="form-control"></td>										
										<td><button type="submit" class="btn btn-primary">Приложи</button></td>
										<td><a href="<?php echo e(route('sales_data_file_list', ['order'=>'id', 'direction' => 'DESC'])); ?>" class="btn btn-warning">Изчисти</a></td>
									</form>
								</tr>
							</thead>
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
									<th class="sortable" id="filename" >ИМЕ НА ФАЙЛА <i class="<?php echo e($arrow_class); ?>"></i></th>
									<th class="sortable" id="created_at">ДАТА на НА ДОБАВЯНЕ <i class="<?php echo e($arrow_class); ?>"></i></a></th>
									<?php if( Auth::user()->role == 'admin'): ?>
										<th>***</th>												
									<?php endif; ?>
								</tr>
							</thead>								
							<tbody>
								<?php							
									if( isset($_GET['page']) ){
										$num = ($_GET['page']-1)*$per_page+1;
										$page = $_GET['page'];
									} else {
										$num = 1;
										$page = 1;
									}
								?>									
								<?php if( $sales_datas->count() > 0 ): ?>										
								<?php $__currentLoopData = $sales_datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e($num); ?></td>	
									<?php
									$num++;
									?>	
									<td>
										<?php echo e($sd->filename); ?>

									</td>
									<td>
										<?php echo e($sd->created_at); ?>

									</td>
									<?php if( Auth::user()->role == 'admin'): ?>									
									<td class="text-center">
										<form action="<?php echo e(route('sales_data_destroy', $sd->id)); ?>" method="post">
											<?php echo e(csrf_field()); ?>

											<input type="hidden" name="delete_date" value="<?php if(isset($filters['date'])){ echo $filters['date']; } else { echo $init_date_range; }?>">
											<input type="hidden" name="sorted" value="<?php echo e($sorted); ?>">
											<input type="hidden" name="direction" value="<?php echo e($direction); ?>">
											<input type="hidden" name="filename" value="<?php if(isset($filters['filename'])){ echo $filters['filename']; } ?>">
											<input type="hidden" name="page" value="<?php echo e($page); ?>">
											<button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Изтрий">
												<i class="fa fa-times" aria-hidden="true"></i>
											</button>
										</form>											
									</td>	
									<?php endif; ?>											                                    
								</tr>								
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php else: ?> 
								<tr>
									<td colspan="4">
										Няма добавени документи с избраните параметри!
									</td>
								</tr>
								<?php endif; ?>								
							</tbody>
						</table>						
					</div>
					<?php echo e($sales_datas->links()); ?>

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
				useCurrent: true,	
				// autoUpdateInput: false						
			}, function(start, end, label) {
				// console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
			});

		$('input[name="date"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
  });

  $('input[name="date"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });
	});

	var sorted = "<?php echo e($sorted); ?>";
	$('#'+sorted + ' i').css({display: 'inline-block'});
	$('#'+sorted ).css({ background: '#F1EFEF'});

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})					

	$('.sortable').on('click', function(){
		var filters = {};
		filters.date = $('input[name="date"]').val();
		filters.filename = $('input[name="filename"]').val();
		
		if ($(this).find('i').attr('class') == 'fas fa-angle-down') {
			var order = $(this).attr('id'),
			direction = 'ASC';
			window.location.href = host+'/sales-data-file-list/'+ order + '/' + direction + '?date=' + filters.date + '&filename=' + filters.filename;
		}
		if ($(this).find('i').attr('class') == 'fas fa-angle-up') {
			var order = $(this).attr('id'),
			direction = 'DESC';
			window.location.href = host+'/sales-data-file-list/'+ order + '/' + direction + '?date=' + filters.date + '&filename=' + filters.filename;
		}
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>