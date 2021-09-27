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
        </div>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">





            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">








                        <div class="col-sm-12">
                            <form action="{{ route('xembanphone') }}" method="get">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Chọn khu vực</label>
                                    <select class="form-control" name="idkhuvuc">
                                        @foreach ($khuvuc as $key => $row)
                                        @if ($row->id == $idkhuvuc)
                                        <option value="{{ $row->id }}" selected>{{ $row->tenkhuvuc }}</option>
                                        @else
                                        <option value="{{ $row->id }}">{{ $row->tenkhuvuc }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Xem bàn</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-sm-12">
                            @if ($errors->any())
                            <h3>{{ $errors->first() }}</h3>
                            @endif
                        </div>

                        @foreach ($ban as $key => $row)

                        @if ($row->trangthai == 0)
                        <div class="card mr-auto" style="width: 114px; height: 285px;">
                            <form action="{{ route('taohoadonphone') }}" method="get">
                                {{ csrf_field() }}
                                <input type="hidden" name="idkhuvuc" value="{{ $idkhuvuc }}">
                                <input type="hidden" name="idban" value="{{ $row->id }}">
                                <input type="image" src="{{ asset('storage/default/banranh.jpg') }}" alt="Submit" width="114px" height="100px">
                            </form>
                            <form action="{{ route('taohoadonphone') }}" method="get">
                                {{ csrf_field() }}
                                <input type="hidden" name="idkhuvuc" value="{{ $idkhuvuc }}">
                                <input type="hidden" name="idban" value="{{ $row->id }}">
                                <input style="font-weight:bold; color:green; font-size:35px; text-align:center; background-color:white; border:none" type="submit" value="{{ Str::limit($row->tenban, 6, '..') }}">
                            </form>
                        </div>
                        @elseif($row->trangthai==1)
                        <div class="card mr-auto" style="width: 114px; height: 285px;">
                            <a href="{{ route('tamtinhhoadonphone', ['id' => $row->id]) }}">
                                <img class="card-img-top" src="{{ asset('storage/default/banban.jpg') }}" alt="Card image cap" width="100px" height="105px">
                            </a>
                            <a href="{{ route('tamtinhhoadonphone', ['id' => $row->id]) }}" style="font-weight:bold; color:red; font-size:35px; text-align:center;">
                                {{ Str::limit($row->tenban, 6, '..') }}
                            </a>
                            <button class="btn btn-primary btn-sm"><a href="{{ route('doimonhoadonphone', ['id' => $row->id]) }}" style="font-weight:bold; color:black; font-size:22px; text-align:center;">Đổi
                                    món</a></button>
                            <button class="btn btn-warning btn-sm"><a href="{{ route('doibanhoadonphone', ['id' => $row->id]) }}" style="font-weight:bold; color:black; font-size:22px; text-align:center;">Đổi
                                    bàn</a></button>
                            <!--idban-->
                            <button stype="button" class="btn btn-danger  btn-sm">
                                <a href="{{ route('deletehoadonphone', ['id' => $row->id]) }}">
                                    <i class="fas fa-trash-alt" style="font-size:30px; color:black; text-align:center;"></i>
                                </a>
                            </button>

                        </div>
                        @endif

                        @endforeach














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

</body>

</html>