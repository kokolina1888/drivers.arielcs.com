@extends('layouts.master')
@section('title', 'Водачи - списък')

@section('content')
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-male"></i> СПИСЪК ВОДАЧИ</h4>
			</div>             
			@if (Session::has('success'))
			<div class="card-header">
				<div class="alert bg-success bg-accent-1 row">
					<div class="col-md-8">
						{{ Session::get('success') }} 
					</div>
					<div class="col-md-1 col-md-offset-3">                         
						<div class="col-xs-1 col-xs-offset-11">
							<a href="{{ route('drivers_list') }}">x</a> 
						</div>                                                                     
					</div>   
				</div>
			</div>
			@endif  
			@if (Session::has('error'))
			<div class="card-header">
				<div class="alert bg-danger bg-accent-1 row">
					<div class="col-md-8">
						{{ Session::get('error') }} 
					</div>
					<div class="col-md-1 col-md-offset-3">                         
						<div class="col-xs-1 col-xs-offset-11">
							<a href="{{ route('drivers_list') }}">x</a> 
						</div>                                                                     
					</div>   
				</div>
			</div>
			@endif
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">                    
					<div class="table-responsive">
						<div class="col-xs-12">
							<table class="table table-bordered col-xs-12">
								<thead>
									<tr>
										<th class="col-xs-1 text-center">#</th>
										<th class="col-xs-4 text-center">Водач - ИМЕ</th>
										<th class="col-xs-1 text-center">Офис</th>
										<th class="col-xs-2 text-center">Тип <span data-toggle="tooltip" data-placement="top" title="Само за офис София"><i class="fas fa-info-circle"></i></span></th>
										<th class="col-xs-1 text-center">Статус</th>
										@if( Auth::user()->role == 'admin')
											<th class="col-xs-1 text-center">***</th>
											<th class="col-xs-1 text-center">деактивиран на:</th>
											<th class="col-xs-1 text-center">***</th>
											<th class="col-xs-1 text-center">***</th>
										@endif
									</tr>
								</thead>								
								<tbody>
									@if( !$drivers->isEmpty() )
										@php
										$num = 1;
										@endphp
										@foreach( $drivers as $d)
										<tr @if($d->status === 0) class="driver-inactive" @endif>
											<th scope="row" class="text-center">{{ $num++ }}</th>
											<td>{{ $d->name }}</td>
											<td class="text-center">{{ $d->office->name }}</td>
											<td class="text-center">
												@if ($d->office->id == 1)
													@if ($d->type == 1)
														София - София
													@endif
													@if ($d->type == 2)
														София - провинция
													@endif
												@endif
											</td>
											<td class="status">
												@if( $d->status === 1)
													активен
												@else 
													неактивен
												@endif
											</td>

											@if( Auth::user()->role == 'admin')
												<td>											
													@if( $d->status === 1)
														<button type="button" class="toggle-status btn btn-primary" data-status="{{ $d->status }}" data-driver="{{ $d->id }}"> 
															деАКТИВИРАЙ
														</button>
													@else 
													 	<button class="toggle-status btn btn-secondary" type="button"  data-status="{{ $d->status }}" data-driver="{{ $d->id }}"> 
															АКТИВИРАЙ
														</button>
													@endif													
												</td>
												<td class="date-deactivated">
													@if( $d->date_deactivated )
														<i>{{ date('d-m-Y', strtotime($d->date_deactivated)) }}</i>
													@endif
												</td>
												<td class="text-center"><a href="{{ route('drivers_edit', $d->id ) }}" class="btn btn-warning mr-1 mb-1" data-toggle="tooltip" data-placement="left" title="Редактирай"><i class="far fa-edit"></i></a></td>
												<td class="text-center">
													<form action="{{ route('drivers_destroy', $d->id) }}" method="post">
													{{ csrf_field() }}
														<button type="submit" class="btn btn-danger mr-1 mb-1" data-toggle="tooltip" data-placement="left" title="Изтрий! Няма да бъде изтрит е въведен в пътен лист!"><i class="fa fa-times" aria-hidden="true"></i>
														</button>
													</form>											
												</td>
											@endif                                    
										</tr>								
										@endforeach
									@else 
										<tr>
											<td colspan="4">
												Няма добавени водачи!
											</td>
										</tr>
									@endif								
								</tbody>
							</table>
						</div>
					</div>
				</div>                
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})

	var token = "{{ Session::token() }}";   
  	var host = "{{URL::to('/')}}";        
  	$.ajaxSetup({
  	    headers: {
  	        'X-CSRF-TOKEN': token
  	    }
  	});
  	
  	$('.toggle-status').on('click', function(e){
    e.preventDefault();
    var driverStatus = $(this).data('status'),
    	driver = $(this).data('driver');
    $.ajax({
      url:host+'/drivers-change-status/'+driver+'/'+driverStatus,      
      type: 'POST',
      success: function(response) {        
       //change button title according to status   
       var element = $('[data-driver="'+driver+'"]'), elementTd = element.parents('td');
       if(response.status == 1){       	
       	
       		element.removeClass('btn-secondary').addClass('btn-primary');
       		element.html('деАКТИВИРАЙ');
       		element.data('status', 1);
       		elementTd.siblings('.status').html('активен');
       		elementTd.siblings('.date-deactivated').html('');         		
       		elementTd.parents('tr').removeClass('driver-inactive')

       } else if(response.status == 0){
       		element.removeClass('btn-primary').addClass('btn-secondary');
       		element.html('АКТИВИРАЙ');  
       		element.data('status', 0);
       		elementTd.siblings('.status').html('неактивен');  
       		elementTd.siblings('.date-deactivated').html('<i>{{ date("d-m-Y")}}</i>');  
       		elementTd.parents('tr').addClass('driver-inactive')
       } 
      },
      error: function(data) { //append error message and try again
       },
      cache: false,
      processData: false,
      contentType: false

    });
   
  });
  
</script>
@endsection