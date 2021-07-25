@extends('layouts.admin')

@section('title')
  <title>Sửa bàn</title>
@endsection
@section('home')
	<li class="nav-item d-none d-sm-inline-block">
		<a href="{{route('thongtinthanhvien')}}" class="nav-link">Home</a>
    </li>
@endsection
@section('dangxuat')
	<ul class="navbar-nav ml-right">
      	<li class="nav-item d-none d-sm-inline-block">
        	<a href="{{route('dangxuatthanhvien')}}" class="nav-link">Đăng xuất</a>
      	</li>
    </ul>
@endsection
@section('quan')
	<a href="{{route('login')}}" class="brand-link">
  		<img src="{!!asset($thanhvien->hinhquan)!!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      	<span class="brand-text font-weight-light">{{$thanhvien->name}}</span>
	</a>
@endsection
@section('avatar')
	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          	<img src="{!!asset($thanhvien->hinhtv)!!}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          	<a href="{{route('thongtinthanhvien')}}" class="d-block">{{$thanhvien->hoten}}</a>
        </div>
    </div>
@endsection

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Sửa bàn</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('thongtinthanhvien')}}">Thông tin thành viên</a></li>
                <li class="breadcrumb-item"><a href="{{route('quanlyban')}}">Quản lý bàn</a></li>
                <li class="breadcrumb-item"><a href="">Sửa bàn</a></li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

            <form action="{{route('doeditban')}}" method="post">
				{{csrf_field()}}
				@if($errors->any())
					<h3>{{$errors->first()}}</h3>
				@endif
                <input type="hidden" name="id" value="{{$ban->id}}">
                <div class="form-group">
                    <label>Chọn khu vực</label>
                    <select class="form-control" name="idkhuvuc">
                    @foreach($khuvuc as $key => $row)
                        @if($ban->idkhuvuc == $row->id)
                        <option value="{{$row->id}}" selected>{{$row->tenkhuvuc}}</option>
                        @else
                        <option value="{{$row->id}}">{{$row->tenkhuvuc}}</option>
                        @endif
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Tên bàn</label>
                    <input type="text" class="form-control" name="tenban" value="{{$ban->tenban}}" required><br>
                    <button type="submit" class="btn btn-primary">Lưu chỉnh sửa</button>
                </div>
            </form>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
