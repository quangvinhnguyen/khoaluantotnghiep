@extends('UI.layout')
@section('content')
<div class ="section group">
    <div class="col-md-6 col-md-push-4">
        <p><strong>Name:</strong> {{ $users->ten_kh }}</p>
        <p><strong>Email:</strong> {{ $users->email }}</p>
        <p><strong>Phone:</strong> {{ $users->sdt }}</p>
        <p><strong>Address:</strong> {{ $users->dia_chi }}</p>
        <a href="#" class="btn btn-danger"> ChangePassword</a>
        <a class="btn btn-success"> edit</a>
    </div>
</div>
   <div class="clear"></div>
@endsection

