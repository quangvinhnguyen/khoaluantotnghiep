@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::model($donhangs, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.donhangs.update', $donhangs->id))) !!}

<div class="form-group">
    {!! Form::label('khachhangs_id', 'Khách hàng*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::select('khachhangs_id', $khachhangs, old('khachhangs_id',$donhangs->khachhangs_id), array('class'=>'form-control')) !!}

    </div>
</div><div class="form-group">
    {!! Form::label('ngay_lap', 'Ngày lập*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('ngay_lap', old('ngay_lap', $donhangs->ngay_lap), array('class'=>'form-control datetimepicker')) !!}

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
                    <tbody id="listchooseproduct" data-ids="{{ json_encode($donhangs->Chitietdonhangs->pluck('sanphams_id')) }}">
                          @php
                          $d=0;
                          @endphp
                          @foreach ($donhangs->Chitietdonhangs as $ct)

                          <tr id="{{ $ct->sanphams_id }}">
                            <td align='center'>
                                    {{$ct->sanphams->ten_sp}}
                            </td>
                            <td>
                                <input class='form-control' name='sanphamUpdate[{{ $d }}][so_luong]' type='text' id='so_luong'value='{{ $ct->so_luong }}'>
                            </td>
                            <td>
                                <input class='form-control' name='sanphamUpdate[{{ $d }}][don_gia]' type='text' id='don_gia'value='{{ $ct->don_gia }}'>
                            </td>
                            <td align='center'>
                            <input type='hidden' name='sanphamUpdate[{{ $d }}][sanphams_id]' value='{{ $ct->sanphams_id }}'>
                            <input type='hidden' name='sanphamUpdate[{{ $d }}][id]' value='{{ $ct->id }}'>
                            <input type='hidden' name='sanphamUpdate[{{ $d }}][donhangs_id]' value='{{ $ct->donhangs_id }}'>
                                <button type='button' class='btn-remove btn-danger fa fa-close'></button>
                            </td>
                             @php
                                ++$d;
                            @endphp
                          </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-6" id='listProducts'></div>
        </div>
    </div>

</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">

        {{ Form::hidden('productDeleteIds', '', [
          'id' => 'productDeleteIds', ]) }}
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.donhangs.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection
