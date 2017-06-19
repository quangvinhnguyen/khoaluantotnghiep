@extends('admin.layouts.master')

@section('content')
<div class"col-md-6">
<h3>THỐNG KÊ SẢN PHẨM HẾT HÀNG</h3>
    <div class="portlet box green">
         <div class="portlet-title">
            <div class="caption">{{ trans('quickadmin::templates.templates-view_index-list') }}</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable" id="datatable">
                <thead>
                    <tr>
                        <th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>CPU</th>
                        <th>Màn Hình</th>
                        <th>Hệ điều hành</th>
                        <th>Ram</th>
                        <th>Camera</th>
                        <th>Pin</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($sanphamhethang as $row)
                        <tr>
                            <td>
                                {!! Form::checkbox('del-'.$row->id,1,false,['class' => 'single','data-id'=> $row->id]) !!}
                            </td>
                            <td>{{ $row->ten_sp }}</td>
<td>{{ isset($row->danhmucs->ten_dm) ? $row->danhmucs->ten_dm : '' }}</td>
<td>{{ $row->so_luong }}</td>
<td>{{ $row->don_gia }}</td>
<td>{{ $row->cpu }}</td>
<td>{{ $row->man_hinh }}</td>
<td>{{ $row->he_dieu_hanh }}</td>
<td>{{ $row->ram }}</td>
<td>{{ $row->camera }}</td>
<td>{{ $row->pin }}</td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">

            </div>

            {!! Form::close() !!}
        </div>
	</div>

</div>

<div class"col-md-6">
<h3>THỐNG KÊ ĐƠN HÀNG THEO NGÀY
<div class="form-group">

    <div class="col-sm-10">
        {!! Form::text('ngay_lap', NULL, array('class'=>'form-control datetimepicker' , 'id' => 'tkdate')) !!}

          {!! Form::submit('thống kế',array('class' => 'btn btn-primary' ,'id' => 'btnthongke')) !!}

    </div>
       </div>
 </h3>
    <div id="listthongkes">
</div>
</div>
@endsection
