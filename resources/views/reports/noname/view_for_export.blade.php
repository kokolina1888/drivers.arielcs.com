<table">
	<!-- loop through trucks here -->
	<thead>
		<tr>
			<th>Дата</th>
			@foreach( $data['document_trucks'] as $dt )
			<th> {{ $dt[0]->number }}-{{ (float)$dt[0]->truck_load }}т </th>
			@endforeach
			<th>
				Общо кг
			</th>
		</tr>
	</thead>
	<tbody>
		@php 
			$super_sum_totals = 0;
		@endphp
		@foreach( $data['documents_dates'] as $date )
		<tr>
			<td> {{ $date->date_created }} </td>
			@php 
				$doc_date_check = $date->date_created;
				$sum_totals = 0;
			@endphp
			@foreach( $data['documents_truck_data'] as $truck_data )
			<td> 
				@if( isset($truck_data[$doc_date_check]) )
					@php
						$sum_totals += $truck_data[$doc_date_check];
					@endphp
				@endif
					{{ $truck_data[$doc_date_check] or '' }}
			</td>
			@endforeach	
			@php 
				$super_sum_totals += $sum_totals;
			@endphp
			<td>
				{{ $sum_totals }}
			</td>							
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<th>Общо за периода /кг/</th>
			@foreach( $data['truck_total_weight'] as $ttw )
			<th> {{ $ttw }} </th>
			@endforeach
			<th>
				{{ $super_sum_totals }}
			</th>
		</tr>
	</tfoot>
</table>