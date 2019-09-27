<table>
	<tbody>			
		@foreach( $data['drivers'] as $driver )
		<tr>
			<th> {{ $driver->driver_name }} </th>
			@foreach( $data['days'] as $day)
			<th>{{ $day }}</th>
			@endforeach
		</tr>
		<tr>
			<td>Тонаж</td>
			@foreach( $data['days'] as $day)
				@if( isset($data['drivers_to_day'][$driver->id]['total_weight_in_sofia'][$day]) )
					<td>{{ $data['drivers_to_day'][$driver->id]['total_weight_in_sofia'][$day] }}</td>
				@else 
					<td></td>
				@endif
			@endforeach
		</tr>
		<tr>
			<td>Брой заявки</td>
			@foreach( $data['days'] as $day)						
				@if( isset($data['drivers_to_day'][$driver->id]['num_requests_in_sofia'][$day]) && $data['drivers_to_day'][$driver->id]['num_requests_in_sofia'][$day] != 0 )
				<td>{{ $data['drivers_to_day'][$driver->id]['num_requests_in_sofia'][$day] }}</td>
				@else 
					<td></td>
				@endif											
			@endforeach
		</tr>
		<tr>
			<td>Провинция</td>
			@foreach( $data['days'] as $day)										
				@if( isset($data['drivers_to_day'][$driver->id]['total_weight_out_sofia'][$day]) )
					<td>{{ $data['drivers_to_day'][$driver->id]['total_weight_out_sofia'][$day] }}</td>
				@else 
					<td></td>
				@endif										
			@endforeach
		</tr>
		<tr>
			<td>Номер на заповед/и</td>
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
				