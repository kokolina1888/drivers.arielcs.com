@extends('layouts.master')
@section('title', 'Справка - Справка')

@section('content')
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-chess-knight"></i> Справка - "Справка"</h4>	
				<p><i>офис <b>{{ $office_data->name }}</b></i></p>			
			</div>        
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">
					<table class="table table-bordered noname">
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
								<th>
									@if( $ttw != 0 ) 
										{{ $ttw }}
									@else 
										0
									@endif 
								</th>
								@endforeach
								<th>
									{{ $super_sum_totals }}
								</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="card-block card-dashboard">
					<a href="{{ route('export_spravka', ['date_range' => $date_range, 'office'=>$office]) }}" class="btn btn-info">Експортирай справката</a>
					<a href="{{ route('reports_spravka_init') }}" class="btn btn-warning">Назад</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection