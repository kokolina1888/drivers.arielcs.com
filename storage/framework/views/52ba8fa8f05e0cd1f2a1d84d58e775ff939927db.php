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
					<form id="filter-period" method="get" action="<?php echo e(route('reports_original_view')); ?>">
						<div class="row">
							<div class="form-group col-md-6">
								<input id="report-date-range" type="text" name="date" value="" class="form-control daterange-input">
							</div>
						</div>
						<div class="row">					
							<div class="col-md-6">                            
                        	    <label for="office">Офис <span data-toggle="tooltip" data-placement="top" title="Изберете офис"><i class="fas fa-info-circle"></i></span></label>
                        	    <select id="office" name="office" class="form-control">                        	        
                        	        <?php $__currentLoopData = $offices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        	        <option value="<?php echo e($o->id); ?>" <?php if( old('office') == $o->id ){ echo 'selected'; }?>><?php echo e($o->name); ?></option>
                        	        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                
                        	    </select>  
                        	    <?php if($errors->has('office')): ?>
                        	        <div class="col-sm-6 text-danger office-error">
                        	            <?php echo e($errors->first('office')); ?> 
                        	        </div>
                        	    <?php endif; ?>                                
                        	</div>
                    	</div>
						<hr>
						<button type="submit" class="btn btn-primary">Прегледай справката</button>
						<a href="#" id="export-report" class="btn btn-warning">Експортирай</a>
						<a href="<?php echo e(route('reports_original_init')); ?>" class="btn btn-info">Задай нов период</a>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	var token = "<?php echo e(Session::token()); ?>";   
						var host = "<?php echo e(URL::to('/')); ?>"; 
	$(function() {           
		$('input[name="date"]').daterangepicker({
			locale: {
				"format": "YYYY-MM-DD",
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
			});
	});
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})

	$('#export-report').on('click', function(e){
		e.preventDefault();
		var date = $('#report-date-range').val(), office = $('#office').val();
		
		window.location.href = host+'/reports-original-export?date_range=' + date + '&office=' + office;
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>