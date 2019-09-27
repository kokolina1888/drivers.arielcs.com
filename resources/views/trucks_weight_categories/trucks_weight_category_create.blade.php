@extends('layouts.master')
@section('title', 'ТОНАЖНА КАТЕГОРИЯ - добави')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">ДОБАВИ ТОНАЖНА КАТЕГОРИЯ</h4>                
            </div>
            <div class="card-body collapse in">
                <div class="card-block">                        
                    <form class="form" method="post" action="{{ route('trucks_weight_category_store') }}">
                        {{ csrf_field() }}
                        <div class="form-body">
                           <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="number">ИМЕ</label>
                                    <input type="text" id="name" class="form-control" placeholder="Име ..." name="name" value="{{ old('name') }}">
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
                                    <input type="text" id="payment" class="form-control" placeholder="Заплащане ..." name="payment" value="{{ old('payment') }}">
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
                            <i class="far fa-save"></i> Запази
                        </button>
                    </div>
                </form>
            </div>               
        </div>
    </div>
</div>
</div>
@endsection