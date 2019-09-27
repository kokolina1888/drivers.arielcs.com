@extends('layouts.master')
@section('title', 'Справка - Шофьори, провинция - курсове в София')

@section('content')
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-dice-d20"></i> Справка - "Шофьори провинция - курсове в София"</h4>								
			</div>        
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">
					<table class="table table-bordered">
						@php 
						$drivers = $data['province_drivers_in_sofia'];
						$count = count($drivers);						
						@endphp
						@if($count > 0)
							@for( $i = 0; $i < $count; $i+=3 )
								<tr>
								@if( isset($drivers[$i]) )								
									<th>
										{{ $drivers[$i]['general']['driver_name'] }}
									</th>
									<th>
										тонаж
									</th>
									<th>
										бр. заявки
									</th>
								@endif
								@if( isset($drivers[$i+1]) )
									<th>
										{{ $drivers[$i+1]['general']['driver_name'] }}
									</th>
									<th>
										тонаж
									</th>
									<th>
										бр. заявки
									</th>
								@endif	
								@if( isset($drivers[$i+2]) )
									<th>
										{{ $drivers[$i+2]['general']['driver_name'] }}
									</th>
									<th>
										тонаж
									</th>
									<th>
										бр. заявки
									</th>
								@endif	
								</tr>
								<!-- for j = 0; j= max_rows; j++ -->
								@php 
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
																
								@endphp
								
								@for($j=0; $j < $max_rows; $j++)
								<tr>
								@if( isset($drivers[$i]) )
									@if( isset($drivers[$i]['data_in_sofia_per_day'][$j]) )	
										<td> {{ $drivers[$i]['data_in_sofia_per_day'][$j]->date_created }} </td>
										<td> {{ $drivers[$i]['data_in_sofia_per_day'][$j]->sum_total_weight }} </td>
										<td> {{ $drivers[$i]['data_in_sofia_per_day'][$j]->requests }} </td>
									@else 
										<td></td>
										<td></td>
										<td></td>
									@endif
								@endif
								@if( isset($drivers[$i+1]) )
									@if( isset($drivers[$i+1]['data_in_sofia_per_day'][$j]) )
										<td> {{ $drivers[$i+1]['data_in_sofia_per_day'][$j]->date_created }} </td>
										<td> {{ $drivers[$i+1]['data_in_sofia_per_day'][$j]->sum_total_weight }} </td>
										<td> {{ $drivers[$i+1]['data_in_sofia_per_day'][$j]->requests }} </td>
									@else 
										<td></td>
										<td></td>
										<td></td>
									@endif
								@endif
								@if( isset($drivers[$i+2]) )
									@if( isset($drivers[$i+2]['data_in_sofia_per_day'][$j]) )
										<td> {{ $drivers[$i+2]['data_in_sofia_per_day'][$j]->date_created }} </td>
										<td> {{ $drivers[$i+2]['data_in_sofia_per_day'][$j]->sum_total_weight }} </td>
										<td> {{ $drivers[$i+2]['data_in_sofia_per_day'][$j]->requests }} </td>
									@else 
										<td></td>
										<td></td>
										<td></td>
									@endif
								@endif
								</tr>
								@endfor
								<tr>
								@if( isset($drivers[$i]) )								
									<th>Общо</th>
									<th>{{ $drivers[$i]['total'][0]->sum_total_weight}}</th>
									<th>{{ $drivers[$i]['total'][0]->requests}}</th>	
								@endif
								@if( isset($drivers[$i+1]) )								
									<th>Общо</th>
									<th>{{ $drivers[$i+1]['total'][0]->sum_total_weight}}</th>
									<th>{{ $drivers[$i+1]['total'][0]->requests}}</th>	
								@endif
								@if( isset($drivers[$i+2]) )								
									<th>Общо</th>
									<th>{{ $drivers[$i+2]['total'][0]->sum_total_weight}}</th>
									<th>{{ $drivers[$i+2]['total'][0]->requests}}</th>	
								@endif
								</tr>
							@endfor
						@endif
					</table>
				</div>

				<div class="card-block card-dashboard">
					<a href="{{ route('export_province_drivers_in_sofia', ['date' => $date_range, 1]) }}" class="btn btn-info">Експортирай справката</a>
					<a href="{{ route('reports_province_drivers_in_sofia_init') }}" class="btn btn-warning">Назад</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection