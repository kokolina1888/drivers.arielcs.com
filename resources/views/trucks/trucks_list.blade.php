@extends('layouts.master')
@section('title', 'МПС - списък')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="fas fa-truck"></i> МПС - списък</h4>                
            </div>
            @if (Session::has('success'))
            <div class="card-header">
                <div class="alert bg-success bg-accent-1 row">
                    <div class="col-md-8">
                        {{ Session::get('success') }} 
                    </div>
                    <div class="col-md-1 col-md-offset-3">                         
                        <div class="col-xs-1 col-xs-offset-11">
                            <a href="{{ route('trucks_list') }}">x</a> 
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
                            <a href="{{ route('trucks_list') }}">x</a> 
                        </div>                                                                     
                    </div>   
                </div>
            </div>
            @endif
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>МПС - РЕГ. НОМЕР</th>
                                    <th>Тонаж</th>
                                    <th>Тонажна категория</th>
                                    <th class="col-xs-1 text-center">Офис</th>
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
                                    @if( !$trucks->isEmpty() )
                                        @php
                                        $num = 1;
                                        @endphp
                                        @foreach( $trucks as $t)
                                        <tr @if($t->status === 0) class="driver-inactive" @endif>
                                            <th scope="row">{{ $num++ }}</th>
                                            <td>{{ $t->number }}</td>
                                            <td>@if($t->truck_load != 0 ){{ $t->truck_load }} @else не е въведен @endif</td>
                                            <td>@if( isset($t->trucks_weight_category->name)){{ $t->trucks_weight_category->name }} @else не е въведена @endif</td>
                                            <td>@if( isset( $t->office ) ) {{ $t->office->name }}@else не е въведен офис @endif</td>

                                            @if( $t->status == 0) <td class="driver-inactive status">неактивен</td> @else <td class="status">активен</td> @endif
                                            @if( Auth::user()->role == 'admin')                                                                                      
                                                <td>                                            
                                                    @if( $t->status === 1)
                                                        <button type="button" class="toggle-status btn btn-primary" data-status="{{ $t->status }}" data-truck="{{ $t->id }}"> 
                                                            деАКТИВИРАЙ
                                                        </button>
                                                    @else 
                                                        <button class="toggle-status btn btn-secondary" type="button"  data-status="{{ $t->status }}" data-truck="{{ $t->id }}"> 
                                                            АКТИВИРАЙ
                                                        </button>
                                                    @endif                                                  
                                                </td>
                                                <td class="date-deactivated">
                                                    @if( $t->date_deactivated )
                                                        <i>{{ date('d-m-Y', strtotime($t->date_deactivated)) }}</i>
                                                    @endif
                                                </td>
                                                <td><a href="{{ route('trucks_edit', $t->id ) }}" class="btn btn-warning mr-1 mb-1" data-toggle="tooltip"  data-placement="left" title="Редактирай"><i class="far fa-edit"></i></a></td>
                                                <td>
                                                    <form action="{{ route('trucks_destroy', $t->id) }}" method="post">
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
                                                Няма добавени автомобили!
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
    var truckStatus = $(this).data('status'),
        truck = $(this).data('truck');
    $.ajax({
      url:host+'/trucks-change-status/'+truck+'/'+truckStatus,      
      type: 'POST',
      success: function(response) {        
       //change button title according to status   
       var element = $('[data-truck="'+truck+'"]'), elementTd = element.parents('td');
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