<table>
	<thead>
		<tr>
			<th>#</th>
			<th>НОМЕР НА<br>ЗАПОВЕД</th>
			<th>ДАТА</th>
			<th>ПЪТЕН ЛИСТ </th>
			<th>МПС<br>/РЕГ.НОМЕР/</th>
			<th>НАЧАЛЕН<br>КИЛОМЕТРАЖ</th>
			<th>КРАЕН<br>КИЛОМЕТРАЖ</th>
			<th >ВОДАЧ 1</th>
			<th >ВОДАЧ 2</th>
			<th>ТОВАРИТЕЛНИЦА<br>№ </th>
			<th>ТОВАРИТЕЛНИЦА<br>ПОЛУЧАТЕЛ </th>
			<th>НАСЕЛЕНО МЯСТО<br>/ АДРЕС / </th>
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