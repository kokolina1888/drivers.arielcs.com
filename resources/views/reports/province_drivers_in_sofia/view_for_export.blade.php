<table>
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
				echo $max_rows;								
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