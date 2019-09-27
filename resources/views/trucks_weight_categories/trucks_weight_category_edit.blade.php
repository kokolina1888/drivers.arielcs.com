@extends('layouts.master')
@section('title', 'ТОНАЖНА КАТЕГОРИЯ - редактирай')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">РЕДАКТИРАЙ ТОНАЖНА КАТЕГОРИЯ</h4>                
            </div>
            <div class="card-body collapse in">
                <div class="card-block">                        
                    <form class="form" action="{{ route('trucks_weight_category_update', $trucks_weight_category->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-body">
                           <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="number">ИМЕ</label>
                                    <input type="text" id="name" class="form-control" value="{{ $trucks_weight_category->name }}" placeholder="Име ..." name="name">
                                    @if($errors->has('name'))
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        {{ $errors->first('name') }} 
                                    </div>
                                    @endif  
                                </div>                                
                            </div>                                    
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="number">ЗАПЛАЩАНЕ</label>
                                    <input type="text" id="payment" class="form-control" value="{{ $trucks_weight_category->payment }}" placeholder="Заплащане ..." name="payment">
                                    @if($errors->has('payment'))
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        {{ $errors->first('payment') }} 
                                    </div>
                                    @endif  
                                </div>
                            </div>                                    
                        </div>
                    </div>
                    <div class="form-actions">                                
                        <button type="submit" class="btn btn-primary">
                            <i class="far fa-save"></i> Промени
                        </button>
                    </div>
                </form>
            </div>               
        </div>
    </div>
</div>
</div>
@endsection