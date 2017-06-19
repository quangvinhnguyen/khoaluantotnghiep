@extends('UI.layout')
@section('content')
<div class ="section group">
    {!! Form::open(array('acion' => '\khachhangsController@changespassword', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}
    </div><div class="form-group">
    {!! Form::label('don_gia', 'Đơn giá*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('don_gia', old('don_gia'), array('class'=>'form-control')) !!}

    </div>
    </div>

    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
        {!! Form::submit(array('class' => 'btn btn-primary')) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>
   <div class="clear"></div>
@endsection
