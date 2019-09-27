@extends('layouts.master')
@section('title', 'Офиси - редактирай')


@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">РЕДАКТИРАЙ ОФИС</h4>                
            </div>
            <div class="card-body collapse in">
                <div class="card-block">                        
                    <form class="form" action="{{ route('offices_update', $office->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-body">
                           <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Офис</label>
                                    <input type="text" id="name" class="form-control" value="{{ $office->name }}" placeholder="Офис ..." name="name">
                                    @if($errors->has('name'))
                                    <div class="col-sm-7 col-sm-offset-1 text-danger">
                                        {{ $errors->first('name') }} 
                                    </div>
                                    @endif  
                                </div>
                            </div>                                    
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">                            
                            <label for="office">Тип</label>
                            <select id="is_sofia" name="is_sofia" class="form-control">
                                <option value="0" <?php if( $office->is_sofia == 0 ){ echo 'selected'; }?>>провинция</option>
                                <option value="1" <?php if( $office->is_sofia == 1 ){ echo 'selected'; }?>>София</option>
                            </select>  
                            @if($errors->has('is_sofia'))
                                <div class="col-sm-7 col-sm-offset-1 text-danger">
                                    {{ $errors->first('is_sofia') }} 
                                </div>
                             @endif  
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