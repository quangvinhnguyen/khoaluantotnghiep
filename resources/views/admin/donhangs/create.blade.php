@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_create-add_new') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::open(array('route' => config('quickadmin.route') . '.donhangs.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

<div class="form-group">
    {!! Form::label('khachhangs_id', 'Khách hàng*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('khachhangs_id', $khachhangs, old('khachhangs_id'), array('class'=>'form-control')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('ngay_lap', 'Ngày lập*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('ngay_lap', old('ngay_lap'), array('class'=>'form-control datetimepicker')) !!}

    </div>
</div>
<div class="form-group">
    <label  class="col-sm-2 control-label">Danh Mục*</label>
    <div class="col-sm-10">
       {!! Form::select('danhmucs_id', $danhmucs, old('danhmucs_id'), array('class'=>'form-control','id'=>'danhmucs_id')) !!}
      <br/>
        <div class="col-md-12">
            <div class="col-md-6">
                <table  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Sự kiện</th>
                        </tr>
                    </thead>
                    <tbody id="listchooseproduct">
                    </tbody>
                </table>
            </div>
            <div class="col-md-6" id='listProducts'></div>
        </div>
    </div>

</div>
<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit( trans('quickadmin::templates.templates-view_create-create') , array('class' => 'btn btn-primary')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection
