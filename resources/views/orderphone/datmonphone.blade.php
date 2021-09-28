<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tạo hóa đơn</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')}}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.css') }}">
    <!-- MyCSS -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/mystyle.css')}}">






    <style>
    </style>










</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">









        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{!! asset($thanhvien->hinhtv) !!}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('thongtinthanhvien') }}" class="d-block">{{ $thanhvien->hoten }}</a>
            </div>
            <div class="info">
                <a href="{{ route('dangxuatthanhvien') }}" class="d-block">Đăng xuất</a>
            </div>
            <div class="info">
                <a href="{{ route('hoadonphone') }}" class="d-block">Order</a>
            </div>
        </div>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">





            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

















                        <div class="col-sm-12">
                            <div class="page-wrapper">
                                <div class="blog-title-area text-center">
                                    <h3>THỰC ĐƠN</h3>
                                </div><!-- end title -->
                                <div class="blog-grid-system">
                                    <div class="row">
                                        @foreach ($thucdon as $key => $row)
                                        <div class="col-sm-6">
                                            <div class="blog-box">
                                                <div class="post-media">

                                                    <div class="row col-sm-12">
                                                        <img src="{{asset($row->hinhmon)}}" height="100px" width="100px">
                                                        <div class="blog-meta big-meta ml-2">
                                                            <h4><a href="" title="">{{ Str::limit($row->tenmon, 20) }}</a></h4>
                                                            <b style="color:red">{{number_format("$row->dongia",0,",",".")}} VNĐ</b>
                                                        </div>
                                                    </div>
                                                    <div class="row col-sm-12 mt-2">
                                                        <form action="{{ route('datmonphone') }}" method="get">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id" value="{{ $id }}">
                                                            <!--idhoadon-->
                                                            <input type="hidden" name="idthucdon" value="{{ $row->id }}">
                                                            <div class="buttons_added">
                                                                <input class="minus is-form" type="button" value="-">
                                                                <input aria-label="quantity" class="input-qty" max="100" min="1" name="soluong" type="number" value="1">
                                                                <input class="plus is-form" type="button" value="+">
                                                                <input type="text" name="ghichu" style="width:100px">
                                                                <button type="submit" class="btn btn-primary">Đặt món</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                            <hr color="red" size="1px">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <hr class="invis">
                            {{$thucdon->links()}}
                        </div>






                        <!-- <div class="col-sm-12">
                            <h1 style="text-align:center">MENU</h1>
                        </div>
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row">
                                                {{-- <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">No.</th> --}}
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">TÊN MÓN</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">ĐƠN GIÁ</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">THAO TÁC</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">LOẠI MÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($thucdon as $key => $row)
                                            <tr class="odd"> -->
                        <!-- <td class="dtr-control sorting_1" tabindex="0">{{$key+1}}</td> -->
                        <!-- <td>{{ $row->tenmon }}</td>
                                                <td>{{ number_format($row->dongia, 0, ',', '.') }}</td>
                                                <td>
                                                    <form action="{{ route('datmonphone') }}" method="get">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $id }}"> -->
                        <!--idhoadon-->
                        <!-- <input type="hidden" name="idthucdon" value="{{ $row->id }}">
                                                        <div class="buttons_added">
                                                            <input class="minus is-form" type="button" value="-">
                                                            <input aria-label="quantity" class="input-qty" max="100" min="1" name="soluong" type="number" value="1">
                                                            <input class="plus is-form" type="button" value="+">
                                                            <input type="text" name="ghichu" style="width:100px">
                                                            <button type="submit" class="btn btn-primary">Đặt món</button>
                                                        </div>
                                                    </form>
                                                </td>
                                                @if ($row->loaimon == 1)
                                                <td>Món Nước</td>
                                                @elseif($row->loaimon==2)
                                                <td>Món Ăn</td>
                                                @elseif($row->loaimon==3)
                                                <td>Món phụ</td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> -->
                        @if ($chitiet != null)
                        <div class="col-sm-12">
                            <h1 style="text-align:center">Các món đã order</h1>
                        </div>
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                {{-- <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">No.</th> --}}
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">TÊN MÓN</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">SỐ LƯỢNG</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">GHI CHÚ</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">TRẠNG THÁI</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">LOẠI MÓN</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">ĐƠN GIÁ</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">GIÁ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($chitiet as $key => $row)
                                            <tr class="odd">
                                                {{-- <td class="dtr-control sorting_1" tabindex="0">{{$key+1}}</td> --}}
                                                <td>{{ $row->tenmon }}</td>
                                                <td>{{ $row->soluong }}</td>
                                                @if ($row->trangthai == 0)
                                                <td>{{ $row->ghichu }}</td>
                                                @elseif($row->trangthai==1)<td bgcolor="yellow" style="color:black">
                                                    {{ $row->ghichu }}</>
                                                </td>
                                                @elseif ($row->trangthai==2)
                                                <td bgcolor="green" style="color:white">{{ $row->ghichu }}</>
                                                </td>
                                                @elseif($row->trangthai==3)
                                                <td bgcolor="red" style="color:white">{{ $row->ghichu }}</>
                                                </td>
                                                @endif
                                                <td class="row">

                                                    @if ($row->trangthai == 0)
                                                    <form action="{{ route('doisoluongmonhoadonphone') }}" method="get">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                                        <input type="hidden" name="dongia" value="{{ $row->dongia }}">
                                                        <div class="buttons_added">
                                                            <input aria-label="quantity" class="input-qty2" max="100" min="1" name="soluong" type="number" value="{{ $row->soluong }}">
                                                            <button type="submit" class="btn btn-warning">Đổi số
                                                                lượng</button>
                                                        </div>
                                                    </form>
                                                    @endif
                                                    @if ($row->trangthai == 1)
                                                    <h5 style="color:orange">Đang thực hiện</h5>
                                                    @endif
                                                    @if ($row->trangthai == 2)
                                                    <h5 style="color:green">Đã xong</h5>
                                                    @endif
                                                    @if ($row->trangthai == 0 || $row->trangthai == 3)
                                                    <form action="{{ route('xoamonhoadonphone') }}" method="get">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                                        <button type="submit" class="btn btn-danger">Xóa
                                                            món</button>
                                                    </form>
                                                    @endif
                                                </td>
                                                @if ($row->loaimon == 1)
                                                <td>Món Nước</td>
                                                @elseif($row->loaimon==2)
                                                <td>Món Ăn</td>
                                                @elseif($row->loaimon==3)
                                                <td>Món phụ</td>
                                                @endif
                                                <td>{{ number_format($row->dongia, 0, ',', '.') }}</td>
                                                <td>{{ number_format($row->gia, 0, ',', '.') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif














                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


    </div>
    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Page specific script -->
    <!-- datatables -->
    <script>
        $(function() {

            $("#example1").DataTable({
                "paging": true, //hien thi phan trang
                "lengthChange": true, //so dong cua 1 trang
                "pageLength": 25, // mac dinh hien thi so dong cua 1 trang
                "searching": true, //o tim kiem
                "ordering": true, // sap xep dong
                "info": true, // hien thi co tat ca bao nhieu dong
                "autoWidth": false, // tu dong thu nho theo kich co man hinh, nen chon false de dung cho dien thoai
                "responsive": true, // nut mo rong khi man hinh bi hep
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],//cac chuc nang khac
                "buttons": ["colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "pageLength": 25,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "buttons": ["colvis"]
            }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

            $('#example3').DataTable({
                "paging": true,
                "lengthChange": true,
                "pageLength": 25,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "buttons": ["colvis"]
            }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

            $('#example4').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": true,
                "responsive": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "buttons": ["print"]
            }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
        });
    </script>
    <!-- Nut tang giam so luong -->
    <script>
        $('input.input-qty').each(function() {
            var $this = $(this),
                qty = $this.parent().find('.is-form'),
                min = Number($this.attr('min')),
                max = Number($this.attr('max'))
            if (min == 0) {
                var d = 0
            } else d = min
            $(qty).on('click', function() {
                if ($(this).hasClass('minus')) {
                    if (d > min) d += -1
                } else if ($(this).hasClass('plus')) {
                    var x = Number($this.val()) + 1
                    if (x <= max) d += 1
                }
                $this.attr('value', d).val(d)
            })
        })
    </script>
    <!-- auto reload -->
    <script type="text/JavaScript">
        function AutoRefresh( t ) {
		setTimeout("location.reload(true);", t);
	}
    </script>
    <!-- my script -->

    <body onload="JavaScript:AutoRefresh(180000);"></body>

</body>

</html>