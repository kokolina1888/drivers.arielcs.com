@extends('layouts.master')
@section('title', 'Справка - Оригинал')

@section('content')
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-barcode"></i> Справка - "Оригинал"</h4>	
				<p><i>офис <b>{{ $office_data->name }}</b></i></p>			
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
										@if( $documents->count() > 0 )
										@php
										$num = 1;
										@endphp
										@foreach( $documents as $d)
										<tr>
											<td>{{ $num++ }}</td>
											@if( isset($d->route_lists) )
												@if( $d->route_lists->count() == 1 )											
												<td>												
													@foreach( $d->route_lists as $rl )
														@if( isset($rl->order_number) )
														{{ $rl->order_number }}
														@endif
														@if( isset($rl->order_number2) )
														, {{ $rl->order_number2 }}
														@endif
													@endforeach												
												</td>
												<td>{{ $d->date_created }}</td>
												<td>
													@foreach( $d->route_lists as $rl )
													{{ $rl->route_list_number }}
													@endforeach
												</td>
												<td>
													@foreach( $d->route_lists as $rl )
													{{ $rl->truck->number}}
													@endforeach
												</td>
												<td>												
													@foreach( $d->route_lists as $rl )
													{{ $rl->km_start }}
													@endforeach
												</td>
												<td>												
													@foreach( $d->route_lists as $rl )
													{{ $rl->km_end }}
													@endforeach																								
												</td>
												<td>												
													@foreach( $d->route_lists as $rl )
													{{ $rl->first_driver->name }}
													@endforeach												
												</td>
												<td>
													@foreach( $d->route_lists as $rl )
														@if( isset($rl->second_driver->name) )
														{{ $rl->second_driver->name }}
														@endif
													@endforeach												
												</td>
												<td>{{ $d->document_number }}</td>
												<td>{{ $d->receiver }}</td>
												<td>{{ $d->receiver_address }}</td>
												<td>
													
													@php 
														if( (str_contains($d->sender, 'ВИВЕКТА') || str_contains($d->sender, 'Вивекта'))){
															foreach( $d->route_lists as $rl ){
																
																	echo $d->total_weight;
																
															}
														}
													@endphp
												</td>
												<td>
													@php 
													if((str_contains($d->sender, 'РОСТАР') || str_contains($d->sender, 'Ростар'))){
														foreach( $d->route_lists as $rl ){
															
																echo $d->total_weight;
															
														}
													}
													@endphp
												</td>
												<td>
													@php 
														if(!str_contains($d->sender, 'РОСТАР') && !str_contains($d->sender, 'Ростар') && !str_contains($d->sender, 'ВИВЕКТА') && !str_contains($d->sender, 'Вивекта')){													
															foreach( $d->route_lists as $rl ){
															
																echo $d->total_weight;
															
														}
														}
													@endphp		
												</td>
												<td>
													@foreach( $d->route_lists as $rl )
														{{ $rl->gas_quant }}
													@endforeach
												</td>
												<td>
													@foreach( $d->route_lists as $rl )
														{{ $rl->km_run }}
													@endforeach
												</td>
												<td>
													@foreach( $d->route_lists as $rl )
														@if( isset($rl->note) )
															{{ $rl->note }}
														@endif
													@endforeach
												</td>
												<td>{{ $d->total_weight }}</td>
												<td></td>														                                    
												<td>
													@foreach( $d->route_lists as $rl )
														@if( $rl->is_international == 1 )
															{{ 'да' }}
														@endif
													@endforeach
												</td>	
											@elseif( $d->route_lists->count() > 1 )											
												<td>												
													@foreach( $d->route_lists as $rl )
														@if( isset($rl->order_number) )
														{{ $rl->order_number }},
														@endif
														@if( isset($rl->order_number2) )
														{{ $rl->order_number2 }},
														@endif
													@endforeach												
												</td>
												<td>{{ $d->date_created }}</td>
												<td>
													@foreach( $d->route_lists as $rl )
													{{ $rl->route_list_number }},
													@endforeach
												</td>
												<td>
													@foreach( $d->route_lists as $rl )
													{{ $rl->truck->number}},
													@endforeach
												</td>
												<td>												
													@foreach( $d->route_lists as $rl )
													{{ $rl->km_start }},
													@endforeach
												</td>
												<td>												
													@foreach( $d->route_lists as $rl )
													{{ $rl->km_end }},
													@endforeach																								
												</td>
												<td>												
													@foreach( $d->route_lists as $rl )
													{{ $rl->first_driver->name }},
													@endforeach												
												</td>
												<td>
													@foreach( $d->route_lists as $rl )
														@if( isset($rl->second_driver->name) )
															{{ $rl->second_driver->name }},
														@endif
													@endforeach												
												</td>
												<td>{{ $d->document_number }}</td>
												<td>{{ $d->receiver }}</td>
												<td>{{ $d->receiver_address }}</td>
												<td>
													
													@php 
														if( (str_contains($d->sender, 'ВИВЕКТА') || str_contains($d->sender, 'Вивекта'))){
															foreach( $d->route_lists as $rl ){
																	echo $d->total_weight . ', ';
																
															}
														}
													@endphp
												</td>
												<td>
													@php 
													if((str_contains($d->sender, 'РОСТАР') || str_contains($d->sender, 'Ростар'))){
														foreach( $d->route_lists as $rl ){
															
																echo $d->total_weight. ', ';
															
														}
													}
													@endphp
												</td>
												<td>
													
													@php 
														if(!str_contains($d->sender, 'РОСТАР') && !str_contains($d->sender, 'Ростар') && !str_contains($d->sender, 'ВИВЕКТА') && !str_contains($d->sender, 'Вивекта')){													
															foreach( $d->route_lists as $rl ){
															
																echo $d->total_weight. ', ';														
															}
														}
													@endphp		
													
												</td>
												<td>
													@foreach( $d->route_lists as $rl )
														{{ $rl->gas_quant }},
													@endforeach
												</td>
												<td>
													@foreach( $d->route_lists as $rl )
														{{ $rl->km_run }},
													@endforeach
												</td>
												<td>
													@foreach( $d->route_lists as $rl )
														@if( isset($rl->note) )
															{{ $d->route_list->note }},
														@endif
													@endforeach
												</td>
												<td>{{ $d->total_weight }}</td>
												<td></td>														                                    
												<td>
													@foreach( $d->route_lists as $rl )
														@if( $rl->is_international == 1 )
															да,
														@endif
													@endforeach
												</td>
											@else
												<td></td>
												<td>{{ $d->date_created }}</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>{{ $d->document_number }}</td>
												<td>{{ $d->receiver }}</td>
												<td>{{ $d->receiver_address }}</td>
												<td>

													@php 
														if( (str_contains($d->sender, 'ВИВЕКТА') || str_contains($d->sender, 'Вивекта'))){
															echo $d->total_weight;
														}
													@endphp
												</td>
												<td>
													@php 
														if((str_contains($d->sender, 'РОСТАР') || str_contains($d->sender, 'Ростар'))){
															echo $d->total_weight;														
														}
													@endphp
												</td>
												<td>													
													@php 
														if(!str_contains($d->sender, 'РОСТАР') && !str_contains($d->sender, 'Ростар') && !str_contains($d->sender, 'ВИВЕКТА') && !str_contains($d->sender, 'Вивекта')){													
															echo $d->total_weight;
														}
													@endphp														
												</td>
												<td></td>
												<td></td>
												<td></td>
												<td>{{ $d->total_weight }}</td>
												<td></td>														                                    
												<td></td>
											@endif
												<!-- no route lists -->
											
										@endif																					                                   
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
	<div class="card-block card-dashboard">
		<a href="{{ route('export_original', ['date_range' => $date_range, 'office'=>$office]) }}" class="btn btn-info">Експортирай справката</a>
		<a href="{{ route('reports_original_init') }}" class="btn btn-warning">Назад</a>
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
@endsection