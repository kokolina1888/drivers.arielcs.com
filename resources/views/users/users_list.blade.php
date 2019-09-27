@extends('layouts.master')
@section('title', 'Потребители - списък')

@section('content')
<div class="row">
	<div class="col-xs-12">		 
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Потребители</h4>
			</div>             
			@if (Session::has('success'))
			<div class="card-header">
				<div class="alert bg-success bg-accent-1 row">
					<div class="col-md-8">
						{{ Session::get('success') }} 
					</div>
					<div class="col-md-1 col-md-offset-3">                         
						<div class="col-xs-1 col-xs-offset-11">
							<a href="{{ route('users_list') }}">x</a> 
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
										<th class="col-xs-1">#</th>
										<th class="col-xs-5">Име</th>
										<th class="col-xs-1">Роля</th>
										<th class="col-xs-1"></th>
									</tr>
								</thead>								
								<tbody>
									@if( !$users->isEmpty() )
										@php
										$num = 1;
										@endphp
										@foreach( $users as $u)
										<tr>
											<th scope="row">{{ $num++ }}</th>
											<td>{{ $u->username }}</td>
											<td>{{ $u->role }}</td>
											@if( $u->role != 'admin')
											<td><a href="{{ route('users_edit', $u->id ) }}" class="btn btn-warning mr-1 mb-1" data-toggle="tooltip" 	data-placement="left" title="Редактирай"><i class="far fa-edit"></i></a></td>											
											<td>
												<form action="{{ route('users_destroy', $u->id) }}" method="post">
												{{ csrf_field() }}
													<button type="submit" class="btn btn-danger mr-1 mb-1" data-toggle="tooltip" data-placement="left" title="Изтрий"><i class="fa fa-times" aria-hidden="true"></i>
													</button>
												</form>											
											</td>
											@endif                                    
										</tr>								
										@endforeach
									@else 
										<tr>
											<td colspan="4">
												Няма добавени потребители!
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