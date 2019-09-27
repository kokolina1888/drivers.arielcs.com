@extends('layouts.master')
@section('title', 'ТОНАЖНИ КАТЕГОРИИ - списък')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Тонажни категории - списък</h4>                
            </div>
            @if (Session::has('success'))
            <div class="card-header">
                <div class="alert bg-success bg-accent-1 row">
                    <div class="col-md-8">
                        {{ Session::get('success') }} 
                    </div>
                    <div class="col-md-1 col-md-offset-3">                         
                        <div class="col-xs-1 col-xs-offset-11">
                            <a href="{{ route('trucks_weight_categories_list') }}">x</a> 
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
                            <a href="{{ route('trucks_weight_categories_list') }}">x</a>
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
                                    <th>Тонажна категория</th>
                                    <th>Заплащане</th>
                                    @if( Auth::user()->role == 'admin')
                                    <th>***</th>
                                    <th>***</th>
                                    @endif
                                </tr>
                            </thead>                            
                            <tbody>
                                    @if( !$trucks_weight_categories->isEmpty() )
                                        @php
                                        $num = 1;
                                        @endphp
                                        @foreach( $trucks_weight_categories as $twc)
                                        <tr>
                                            <th scope="row">{{ $num++ }}</th>
                                            <td>{{ $twc->name }}</td>
                                            <td>{{ $twc->payment }}</td>
                                            @if( Auth::user()->role == 'admin')
                                            <td><a href="{{ route('trucks_weight_category_edit', $twc->id ) }}" class="btn btn-warning mr-1 mb-1" data-toggle="tooltip"  data-placement="left" title="Редактирай"><i class="far fa-edit"></i></a></td>
                                            <td>
                                                <form action="{{ route('trucks_weight_category_destroy', $twc->id) }}" method="post">
                                                {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger mr-1 mb-1" data-toggle="tooltip" data-placement="left" title="Изтрий! Няма да бъде изтрита е въведена към МПС!"><i class="fa fa-times" aria-hidden="true"></i>
                                                    </button>
                                                </form>                                         
                                            </td>  
                                            @endif                                  
                                        </tr>                               
                                        @endforeach
                                    @else 
                                        <tr>
                                            <td colspan="4">
                                                Няма добавени тонажни категории!
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
@endsection