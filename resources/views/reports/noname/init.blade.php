@extends('layouts.master')
@section('title', 'Справка - без име')

@section('content')
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-bezier-curve"></i> Справка - "Без име"</h4>	
				<p><i>Товари по дни по МПС, включително международен транспорт. Суми по дни и по камиони. Обща сума за периода. Само МПС с товари за периода.</i></p>			
			</div>        
			<div class="card-body collapse in">
				<div class="card-block card-dashboard"> 
					<form id="filter-period" method="get" action="{{ route('reports_noname_view') }}">
						<div class="row">
							<div class="form-group col-md-6">
								<input id="report-date-range" type="text" name="date" value="" class="form-control daterange-input">
							</div>
						</div>
						<div class="row">					
							<div class="col-md-6">                            
                        	    <label for="office">Офис <span data-toggle="tooltip" data-placement="top" title="Изберете офис"><i class="fas fa-info-circle"></i></span></label>
                        	    <select id="office" name="office" class="form-control">                        	        
                        	        @foreach( $offices as $o)
                        	        <option value="{{ $o->id }}" <?php if( old('office') == $o->id ){ echo 'selected'; }?>>{{ $o->name }}</option>
                        	        @endforeach                                                
                        	    </select>  
                        	    @if($errors->has('office'))
                        	        <div class="col-sm-6 text-danger office-error">
                        	            {{ $errors->first('office') }} 
                        	        </div>
                        	    @endif                                
                        	</div>
                    	</div>
						<hr>
						<button type="submit" class="btn btn-primary">Прегледай справката</button>
						<a href="#" id="export-report" class="btn btn-warning">Експортирай</a>
						<a href="{{ route('reports_noname_init') }}" class="btn btn-info">Задай нов период</a>
					</form>

				</div>
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
		var date = $('#report-date-range').val(), office = $('#office').val();
		
		window.location.href = host+'/reports-noname-export?date_range=' + date + '&office='+office;
	});
</script>
@endsection