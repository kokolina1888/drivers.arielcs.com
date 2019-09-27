<table>
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
				<th colspan="4">камиони по тонажни категории</th>
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
				