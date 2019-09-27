@extends('layouts.master')
@section('title', 'Справка - Шофьори, провинциални - курсове в София')

@section('content')
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-dice-d20"></i> Справка - "Шофьори, провинциални - курсове в София" </h4>				
				<p><i>Шофьори от офис София, тип "София - провинция", без командировъчни заповеди /= курс в София/. Тонаж и брой заявки по дни за избран период. Общ тонаж и брой заявки за периода.</i></p>
			</div>        
			<div class="card-body collapse in">
				<div class="card-block card-dashboard"> 
					<form id="filter-period" method="get" action="{{ route('reports_province_drivers_in_sofia_view') }}">
						<div class="row">
							<div class="form-group col-md-6">
								<input id="report-date-range" type="text" name="date" value="" class="form-control daterange-input">
							</div>
						</div>						                  	
						<hr>
						<button type="submit" class="btn btn-primary">Прегледай справката</button>
						<a href="#" id="export-report" class="btn btn-warning">Експортирай</a>
						<a href="{{ route('reports_drivers_for_period_init') }}" class="btn btn-info">Задай нов период</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var token = "{{ Session::token() }}";   
						var host = "{{URL::to('/')}}"; 
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
				console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
			});
	});
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})

	$('#export-report').on('click', function(e){
		e.preventDefault();
		$('.office-error').html('');
		var date = $('#report-date-range').val(), 
		office = '';
		$.each($("input[type='checkbox']"), function(k, v) {
			if (v.checked == true)
				{
				  office += '-'+ v.value;
				}
			
		})
		
		
		window.location.href = host+'/reports-province-drivers-in-sofia-export?date=' + date + '&office='+office;
	});
</script>
@endsection