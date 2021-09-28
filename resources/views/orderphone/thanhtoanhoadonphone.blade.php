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
                            @if ($errors->any())
                            <h3>{{ $errors->first() }}</h3>
                            @endif
                            <!-- popup -->
                            <div class="col-sm-12 mb-4 text-right">
                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalLoginForm"><i class="fas fa-plus"></i></a>
                            </div>

                            <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <b style="text-align:center">Khuyến mãi</b>
                                        <form action="{{ route('giamgiaphone') }}" method="get">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $id }}"><!-- idhoadon -->
                                            <div class="modal-body mx-3">
                                                <div class="md-form mb-5">
                                                    <label>Nhập số điện thoại</label>
                                                    <input required="true" type="tel" class="form-control" name="sdt" placeholder="0123456789" pattern="[0-9]{10}">
                                                    <label>Nhập số diểm</label>
                                                    <input required="true" type="number" class="form-control" name="diem" value="-1">
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button class="btn btn-default">Check</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- popup -->



                            <table>
                                <b class="row justify-content-center">HÓA ĐƠN BÁN LẺ</b>
                                <tr style="border:none">
                                    <td colspan="2" style="border:none">
                                        <b style="text-align:left">Tên quán: {{ $thanhvien->name }}</b>
                                    </td>
                                    <td style="border:none"></td>
                                    <td colspan="2" style="border:none">
                                        <b style="text-align:left">Thời gian: {{ $hoadon->thoigian }}</b>
                                    </td>
                                </tr>
                                <tr style="border:none">
                                    <td colspan="2" style="border:none">
                                        <b style="text-align:left">Địa chỉ: {{ $thanhvien->diachiquan }}</b>
                                    </td>
                                    <td style="border:none"></td>
                                    <td colspan="2" style="border:none">
                                        <b style="text-align:left">Khu vực: {{ $hoadon->tenkhuvuc }}</b>
                                    </td>
                                </tr>
                                <tr style="border:none">
                                    <td colspan="2" style="border:none">
                                        <b style="text-align:left">Website: {{ $thanhvien->website }}</b>
                                    </td>
                                    <td style="border:none"></td>
                                    <td colspan="2" style="border:none">
                                        <b style="text-align:left">Bàn: {{ $hoadon->tenban }}</b>
                                    </td>
                                </tr>
                                <tr style="border:none">
                                    <td colspan="2" style="border:none">
                                        <b style="text-align:left">Liên hê: {{ $thanhvien->sdtquan }}</b>
                                    </td>
                                    <td style="border:none"></td>
                                    <td colspan="2" style="border:none">
                                        <b style="text-align:left">NV phục vụ: {{ $hoadon->hoten }}</b>
                                    </td>
                                </tr>
                            </table>
                            <div class="card">
                                <div class="card-body">
                                    <table id="example4" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example3_info">

                                        <thead>
                                            <tr role="odd">
                                                <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1">TÊN MÓN</th>
                                                <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1">ĐƠN GIÁ</th>
                                                <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1">SL</th>
                                                <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1">T.TIỀN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($chitiet as $key => $row)
                                            <tr class="odd">
                                                <td>{{$key+1}}.&nbsp;&nbsp;{{ $row->tenmon }}</td>
                                                <td>{{ number_format("$row->dongia", 0, ',', '.') }}đ</td>
                                                <td>{{ number_format("$row->soluong", 0, ',', '.') }}</td>
                                                <td>{{ number_format("$row->gia", 0, ',', '.') }}đ</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <th>Tạm tính:</th>
                                                <td></td>
                                                <td></td>
                                                <th>{{ number_format("$tamtinh", 0, ',', '.') }}đ</th>
                                            </tr>
                                            <tr>
                                                <th>Giảm giá:</th>
                                                <td></td>
                                                <td></td>
                                                <th><?php $giamgia = $diem * $diemtohoadon; ?>{{ number_format("$giamgia", 0, ',', '.') }}đ</th>
                                            </tr>
                                            <tr>
                                                <th>TỔNG:</th>
                                                <td></td>
                                                <td></td>
                                                <th><?php $tong = $tamtinh - $diem * $diemtohoadon; ?>{{ number_format("$tong", 0, ',', '.') }}đ</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>





                            <form action="{{ route('thanhtoanhoadonphone') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $id }}"><!-- idhoadon-->
                                <input type="hidden" name="idban" value="{{ $idban }}"><!-- idban-->
                                <input type="hidden" name="diem" value="{{ $diem }}"><!-- diem-->
                                <input type="hidden" name="idkhachhang" value="{{ $idkhachhang }}">
                                <!--idkhachhang -->
                                <input type="hidden" name="diemkhachhang" value="{{ $diemkhachhang }}">
                                <!--diemkhachhang -->
                                <input type="hidden" name="giamgia" value="{{ $giamgia }}">
                                <!--diemkhachhang -->
                                <input type="hidden" name="thanhtien" value="{{ $tong }}">
                                <!--thanhtien -->
                                <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn có chắc chắn muốn thanh toán')">Thanh toán</button>
                            </form>

                        </div>














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