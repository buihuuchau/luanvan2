@extends('layouts.admin')

@section('title')
    <title>Quản lý nguyên liệu</title>
@endsection
@section('home')
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('thongtinthanhvien') }}" class="nav-link">Home</a>
    </li>
@endsection
@section('dangxuat')
    <ul class="navbar-nav ml-right">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dangxuatthanhvien') }}" class="nav-link">Đăng xuất</a>
        </li>
    </ul>
@endsection
@section('quan')
    <a href="{{ route('login') }}" class="brand-link">
        <img src="{{ $thanhvien->hinhquan }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $thanhvien->name }}</span>
    </a>
@endsection
@section('avatar')
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ $thanhvien->hinhtv }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{ route('thongtinthanhvien') }}" class="d-block">{{ $thanhvien->hoten }}</a>
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
                        <h1 class="m-0">Quản lý nguyên liệu</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('thongtinthanhvien') }}">Thông tin thành
                                    viên</a>
                            </li>
                            <li class="breadcrumb-item"><a href="">Quản lý nguyên liệu</a></li>
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

                    <div class="col-sm-12">
                        <div class="col-md-12 mb-4 text-right">

                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModalCenter">
                                Thêm nguyên liệu
                            </button>
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Thêm nguyên liệu</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('doaddnguyenlieu') }}" method="post">
                                            <div class="modal-body">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label>Tên nguyên liệu</label>
                                                    <input type="text" class="form-control" name="tennguyenlieu"
                                                        required><br>
                                                    <label>Xuất xứ</label>
                                                    <input type="text" class="form-control" name="xuatxu" required><br>
                                                    <label>Đơn vị tính</label>
                                                    <input type="text" class="form-control" name="donvitinh" required><br>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Thêm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                        @if ($errors->any())
                            <h3>{{ $errors->first() }}</h3>
                        @endif

                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                    role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            {{-- <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">No.</th> --}}
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1">TÊN NGUYÊN LIỆU</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1">XUẤT XỨ</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1">ĐƠN VỊ TÍNH</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1">ẨN / HIỆN</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                colspan="1">THAO TÁC</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nguyenlieu as $key => $row)
                                            <tr class="odd">
                                                {{-- <td class="dtr-control sorting_1" tabindex="0">{{$key+1}}</td> --}}
                                                <td>{{ $row->tennguyenlieu }}</td>
                                                <td>{{ $row->xuatxu }}</td>
                                                <td>{{ $row->donvitinh }}</td>
                                                @foreach ($kho as $key2 => $row2)
                                                    <?php if ($row2->idnguyenlieu == $row->id) {
                                                        $sudung = $row->id;
                                                    }
                                                    ?>
                                                @endforeach

                                                @if ($row->hidden == 0 && $sudung != $row->id)
                                                    <td>Chưa được sử dụng</td>
                                                @elseif($row->hidden==0 && $sudung==$row->id)
                                                    <td bgcolor="lightgreen">Đang được sử dụng</td>
                                                @else
                                                    <td bgcolor="gray" style="color:white">Vô hiệu hóa</td>
                                                @endif
                                                <td class="row">

                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#exampleModalCenter{{ $row->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button><br>
                                                    <div class="modal fade" id="exampleModalCenter{{ $row->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Sửa
                                                                        nguyên liệu</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="{{ route('doeditnguyenlieu') }}"
                                                                    method="post">
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $row->id }}">
                                                                    <div class="modal-body">
                                                                        {{ csrf_field() }}
                                                                        <div class="form-group">
                                                                            <label>Tên nguyên liệu</label>
                                                                            <input type="text" class="form-control"
                                                                                name="tennguyenlieu"
                                                                                value="{{ $row->tennguyenlieu }}"
                                                                                required>
                                                                        <div class="form-group">
                                                                            </div>
                                                                            <label>Xuất xứ</label>
                                                                            <input type="text" class="form-control"
                                                                                name="xuatxu" value="{{ $row->xuatxu }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Đơn vị tính</label>
                                                                            <input type="text" class="form-control"
                                                                                name="donvitinh"
                                                                                value="{{ $row->donvitinh }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Lưu
                                                                            chỉnh sửa</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if ($row->hidden == 0)
                                                        <button class="btn btn-secondary">
                                                            <a href="{{ route('hiddennguyenlieu', ['id' => $row->id]) }}"
                                                                style="color: white"><i class="fa fa-times"></i></a>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-success">
                                                            <a href="{{ route('shownguyenlieu', ['id' => $row->id]) }}"
                                                                style="color: white"><i class="fas fa-check"></i></a>
                                                        </button>
                                                    @endif

                                                    @if ($sudung != $row->id)
                                                        <button class="btn btn-danger">
                                                            <a href="{{ route('deletenguyenlieu', ['id' => $row->id]) }}"
                                                                style="color: black"
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa')">
                                                                <i class="fas fa-trash"></i></a>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
