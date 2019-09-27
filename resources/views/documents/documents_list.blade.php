@extends('layouts.master')
@section('title', 'Товарителници - списък')

@section('content')
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-clipboard-list"></i> Списък товарителници</h4>
			</div>             

			@if (Session::has('success'))
			<div class="card-header">
				<div class="alert bg-success bg-accent-1 row">
					<div class="col-md-8">
						{{ Session::get('success') }} 
					</div>
					<div class="col-md-1 col-md-offset-3">                         
						<div class="col-xs-1 col-xs-offset-11">
							<a href="{{ route('documents_list', ['order'=>'id', 'direction'=> 'DESC']) }}">x</a> 
						</div>                                                                     
					</div>   
				</div>
			</div>
			@endif  
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">								
					<div class="table-responsive">
						<table class="table">							
							<form id="filter-form" method="get" action="{{ route('documents_list', ['id', 'DESC']) }}">
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
												@foreach( $trucks as $t)
												<option value="{{ $t->id }}"
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
													>{{ $t->number }}</option>
												@endforeach
											</select>
										</td>
										<td>
											<select type="text" name="first_driver" class="form-control">
												<option value="">-- изберете --</option>
												@foreach( $drivers as $d)
												<option value="{{ $d->id }}"
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
													>{{ $d->name }}</option>
												@endforeach
											</select>
										</td>
										<td>
											<select type="text" name="second_driver" class="form-control">
												<option value="">-- изберете --</option>
												@foreach( $drivers as $d)
												<option value="{{ $d->id }}"
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

													>{{ $d->name }}</option>
												@endforeach
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
											<a href="{{ route('documents_list', ['order'=>'id', 'direction' => 'DESC']) }}" class="btn btn-warning">Изчисти</a>
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
										<th class="sortable" id="on" >НОМЕР НА<br>ЗАПОВЕД <i class="{{ $arrow_class }}"></i></th>
										<th class="sortable" id="dc">ДАТА <i class="{{ $arrow_class }}"></i></a></th>
										<th class="sortable" id="rl">ПЪТЕН ЛИСТ <i class="{{ $arrow_class }}"></i></th>
										<th class="sortable" id="tn">МПС<br>/РЕГ.НОМЕР/ <i class="{{ $arrow_class }}"></i></th>
										<th>НАЧАЛЕН<br>КИЛОМЕТРАЖ</th>
										<th>КРАЕН<br>КИЛОМЕТРАЖ</th>
										<th class="sortable" id="fd">ВОДАЧ 1 <i class="{{ $arrow_class }}"></i></th>
										<th class="sortable" id="sd">ВОДАЧ 2 <i class="{{ $arrow_class }}"></i></th>
										<th class="sortable" id="dn">ТОВАРИТЕЛНИЦА<br>№ <i class="{{ $arrow_class }}"></i></th>
										<th class="sortable" id="r">ТОВАРИТЕЛНИЦА<br>ПОЛУЧАТЕЛ <i class="{{ $arrow_class }}"></i></th>
										<th class="sortable" id="ra">НАСЕЛЕНО МЯСТО<br>/ АДРЕС / <i class="{{ $arrow_class }}"></i></th>
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
									@if( $documents->count() > 0 )
										@php
										if( isset($_GET['page']) ){
											$num = ($_GET['page']-1)*$per_page+1;
										} else {
											$num = 1;
										}
										@endphp
										@foreach( $documents as $d)
											<tr>
												<td>{{ $num }}</td>	
												@php
													$num++;
												@endphp	
												<td>													
													@if( isset($d->route_lists) )
														@foreach($d->route_lists as $rl)
															@if( isset($rl->order_number) )
																{{ $rl->order_number }},															
															@endif	
															@if( isset($rl->order_number2) )
																{{ $rl->order_number2 }},
															@endif
														@endforeach															
													@endif
												</td>
												<td>{{ $d->date_created }}</td>
												<td>@if( isset($d->route_lists) )
														@foreach($d->route_lists as $rl)
															{{ $rl->route_list_number }} 
														@endforeach
													@endif
												</td>
												<td>@if( isset($d->route_lists) )
														@foreach($d->route_lists as $rl)														
															{{ $rl->truck->number}} 
														@endforeach
													@endif
												</td>
												<td>
													@if( isset($d->route_lists) )
														@foreach($d->route_lists as $rl)														
															{{ $rl->km_start }} 
														@endforeach
													@endif
												</td>
												<td>
													@if( isset($d->route_lists) )
														@foreach($d->route_lists as $rl)														
															{{ $rl->km_end }} 
														@endforeach
													@endif
												</td>
												<td>
													@if( isset($d->route_lists) )
														@foreach($d->route_lists as $rl)														
															{{ $rl->first_driver->name }} 
														@endforeach
													@endif
												</td>												
												<td>
													@if( isset($d->route_lists) )
														@foreach($d->route_lists as $rl )
															@if( isset($rl->second_driver->name) )
																{{ $rl->second_driver->name }}
															@endif
														@endforeach
													 @endif
												</td>

												<td>{{ $d->document_number }}</td>
												<td>{{ $d->receiver }}</td>
												<td>{{ $d->receiver_address }}</td>
												<td>
												@if( isset($d->route_list) )
												@php 
													if( (str_contains($d->sender, 'ВИВЕКТА') || str_contains($d->sender, 'Вивекта')) && ($d->route_list->is_international == 0) ){
														echo $d->total_weight;
													}
												@endphp
												@else 
													@php
													if( (str_contains($d->sender, 'ВИВЕКТА') || str_contains($d->sender, 'Вивекта'))){
														echo $d->total_weight;
													}
													@endphp
												@endif
												</td>
												<td>
												@if( isset($d->route_list) )
												@php 
													if((str_contains($d->sender, 'РОСТАР') || str_contains($d->sender, 'Ростар')) && ($d->route_list->is_international == 0)){
														echo $d->total_weight;
													}
												@endphp
												@else 
												@php 
													if((str_contains($d->sender, 'РОСТАР') || str_contains($d->sender, 'Ростар'))){
														echo $d->total_weight;
													}
												@endphp
												@endif
												</td>
												<td>
												@php 
												if(!str_contains($d->sender, 'РОСТАР') && !str_contains($d->sender, 'Ростар') && !str_contains($d->sender, 'ВИВЕКТА') && !str_contains($d->sender, 'Вивекта')){													
															echo $d->total_weight;
														}
													@endphp	
												</td>
												<td>{{ $d->gas_quant }}</td>
												<td>{{ $d->km_run }}</td>
												<td>@if( isset($d->route_list) ){{ $d->route_list->note }}@endif</td>
												<td>{{ $d->total_weight }}</td>
												<td>													
													@if( isset($d->route_lists) )
														@foreach( $d->route_lists as $rl)
															@if( $rl->pivot->is_repeated )
																повторение
															@endif
														@endforeach
													@endif
												</td>														                                    
												<td>
													@if( isset($d->route_lists) )
														@foreach( $d->route_lists as $rl )
															@if( $rl->is_international == 1 )
																{{ 'да' }}
															@endif
														@endforeach
													@endif
												</td>														                                    
											</tr>								
										@endforeach
									@else 
										<tr>
											<td colspan="20">
												Няма добавени документи с избраните параметри!
											</td>
										</tr>
									@endif								
								</tbody>
							</table>
						</div>												
					</div>
					</div>
					{{ $documents->links() }}
				</div>                
			</div>
		</div>
	</div>
</div>
	<script type="text/javascript">
						var token = "{{ Session::token() }}";   
						var host = "{{URL::to('/')}}"; 
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

		var sorted = "{{ $sorted }}";
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
@endsection