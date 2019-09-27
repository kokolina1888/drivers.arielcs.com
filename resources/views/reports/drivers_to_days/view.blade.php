@extends('layouts.master')
@section('title', 'Справка - Шофьори - по дни')

@section('content')
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-code-branch"></i> Справка - "Шофьори - по дни"</h4>			
				<p><i>офис <b>{{ $office_data->name }}</b></i></p>	
			</div>        
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">
					<table class="table table-bordered">
						<tbody>			
							@foreach( $data['drivers'] as $driver )
								<tr class="driver-header">
									<td> {{ $driver->driver_name }} </td>
									@foreach( $data['days'] as $day)
									<td>{{ $day }}</td>
									@endforeach
								</tr>
								<tr>
									<td>Тонаж <span data-toggle="tooltip" data-placement="top" title="за рамките на София"><i class="fas fa-info-circle"></i></span></td>
									@foreach( $data['days'] as $day)
										@if( isset($data['drivers_to_day'][$driver->id]['total_weight_in_sofia'][$day]) )
											<td>{{ $data['drivers_to_day'][$driver->id]['total_weight_in_sofia'][$day] }}</td>
										@else 
											<td></td>
										@endif
									@endforeach
								</tr>
								<tr>
									<td>Брой заявки <span data-toggle="tooltip" data-placement="top" title="за рамките на София"><i class="fas fa-info-circle"></i></span></td>
									@foreach( $data['days'] as $day)						
										@if( isset($data['drivers_to_day'][$driver->id]['num_requests_in_sofia'][$day]) && $data['drivers_to_day'][$driver->id]['num_requests_in_sofia'][$day] != 0 )
											<td>{{ $data['drivers_to_day'][$driver->id]['num_requests_in_sofia'][$day] }}</td>
										@else 
											<td></td>
										@endif											
									@endforeach
								</tr>
								<tr>
									<td>Провинция <span data-toggle="tooltip" data-placement="top" title="тонаж"><i class="fas fa-info-circle"></i></span></td>
									@foreach( $data['days'] as $day)										
										@if( isset($data['drivers_to_day'][$driver->id]['total_weight_out_sofia'][$day]) )
											<td>{{ $data['drivers_to_day'][$driver->id]['total_weight_out_sofia'][$day] }}</td>
										@else 
											<td></td>
										@endif										
									@endforeach
								</tr>
								<tr>
									<td>Номер на заповед/и <span data-toggle="tooltip" data-placement="top" title="курсове в провинция"><i class="fas fa-info-circle"></i></span></td>
									@foreach( $data['days'] as $day)																			
										@if( isset($data['drivers_to_day'][$driver->id]['order_nums_out_sofia'][$day]) )										
											<td>
												@foreach( $data['drivers_to_day'][$driver->id]['order_nums_out_sofia'][$day] as $order_number )
												{{ $order_number->order_number }},
												@endforeach
											</td>
										@else 
											<td></td>
										@endif										
									@endforeach
								</tr>								
							@endforeach
						</tbody>						
					</table>
				</div>
				<div class="card-block card-dashboard">
					<a href="{{ route('export_drivers_to_days', ['date_range' => $date_range, 'office'=>$office]) }}" class="btn btn-info">Експортирай справката</a>
					<a href="{{ route('reports_drivers_to_days_init') }}" class="btn btn-warning">Назад</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection