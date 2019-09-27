@extends('layouts.master')
@section('title', 'Офиси - списък')

@section('content')
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="fas fa-igloo"></i> СПИСЪК Офиси</h4>
			</div>             
			@if (Session::has('success'))
			<div class="card-header">
				<div class="alert bg-success bg-accent-1 row">
					<div class="col-md-8">
						{{ Session::get('success') }} 
					</div>
					<div class="col-md-1 col-md-offset-3">                         
						<div class="col-xs-1 col-xs-offset-11">
							<a href="{{ route('offices_list') }}">x</a> 
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
							<a href="{{ route('offices_list') }}">x</a> 
						</div>                                                                     
					</div>   
				</div>
			</div>
			@endif  
			<div class="card-body collapse in">
				<div class="card-block card-dashboard">                    
					<div class="table-responsive">
						<div class="col-xs-8">
							<table class="table col-xs-8">
								<thead>
									<tr>
										<th class="col-xs-1  text-center">#</th>
										<th class="col-xs-5 text-center">Офис</th>										
										@if( Auth::user()->role == 'admin')
										<th class="col-xs-1 text-center">***</th>
										<th class="col-xs-1 text-center">***</th>
										@endif
									</tr>
								</thead>								
								<tbody>
									@if( !$offices->isEmpty() )
										@php
										$num = 1;
										@endphp
										@foreach( $offices as $o)
										<tr>
											<td scope="row" class="text-center">{{ $num++ }}</th>
											<td class="text-center">{{ $o->name }}</td>
											
											@if( Auth::user()->role == 'admin' && $o->id != 1 )
											<td class="text-center"><a href="{{ route('offices_edit', $o->id ) }}" class="btn btn-warning mr-1 mb-1" data-toggle="tooltip" 	data-placement="left" title="Редактирай"><i class="far fa-edit"></i></a></td>
											<td class="text-center">
												<form action="{{ route('offices_destroy', $o->id) }}" method="post">
												{{ csrf_field() }}
													<button type="submit" class="btn btn-danger mr-1 mb-1" data-toggle="tooltip" data-placement="left" title="Изтрий! Няма да бъде изтрит ако е добавен към водач!"><i class="fa fa-times" aria-hidden="true"></i>
													</button>
												</form>											
											</td>
											@endif                                    
										</tr>								
										@endforeach
									@else 
										<tr>
											<td colspan="4">
												Няма добавени офиси!
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
</script>
@endsection