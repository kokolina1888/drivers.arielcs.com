@extends('layouts.master')
@section('title', 'Справка - Шофьори - сумарна за период')

@section('content')
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-chess"></i> Справка - "Шофьори - сумарна за период"</h4>
				<p><i>офис <b>{{ $office->name }}</b></i></p>				
			</div>        
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Офис - {{ $office->name }}</th>
								<th>неделни</th>
								<th>ремарке</th>
								<th>КОМАНДИРОВКИ - брой</th>
								@foreach( $data['trucks_by_weight_category'] as $twc )
								<th>{{ $twc->name }}</th>
								@endforeach
								<th>ТОНАЖ - СОФИЯ</th>
								<th>БРОЙ ЗАЯВКИ - СОФИЯ</th>
								<th>ОБЩО</th>
								<th>ПОДПИС</th>
							</tr>
						</thead>
						<tbody>
							@foreach( $data['drivers_for_period'] as $driver)
							<tr>
								<td>{{ $driver['general']['driver_name'] }}</td>
								<td></td>
								<td></td>
								<td>{{ $driver['num_order_numbers'] }}</td>
								@foreach( $data['trucks_by_weight_category'] as $twc )
								<td>{{ $driver['num_order_numbers_per_truck_weight_category'][$twc->id] }}</td>
								@endforeach
								<td>{{ $driver['total_weight_in_sofia'] }}</td>
								<td>{{ $driver['num_requests_in_sofia'] }}</td>
								<td></td>
								<td></td>
							</tr>
							@endforeach							
						</tbody>		
						<tfoot>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								@foreach( $data['trucks_by_weight_category'] as $twc )
									<td></td>
								@endforeach
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							@for( $i = 0; $i < $data['trucks_weight_category_max_trucks']; $i++ )
								<tr>
									@if( $i == 0 )
									<th colspan="4" class="text-right">камиони по тонажни категории</th>
									@else
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									@endif
									@foreach( $data['trucks_by_weight_category'] as $twc )
										<td>
											@if( isset($twc->trucks[$i]))
												{{ $twc->trucks[$i]->number }}
											@endif
										</td>
									@endforeach
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							@endfor
						</tfoot>	
					</table>
				</div>
				<div class="card-block card-dashboard">
					<a href="{{ route('export_drivers_for_period', ['date_range' => $date_range, 'office'=>$office->id]) }}" class="btn btn-info">Експортирай справката</a>
					<a href="{{ route('reports_drivers_for_period_init') }}" class="btn btn-warning">Назад</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection