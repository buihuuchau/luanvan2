<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')
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
    @yield('css')
</head>

<body class="hold-transition sidebar-mini">
    <center>
        <h1>QUẢN LÝ CÁC CƠ SỞ KINH DOANH</h1>
    </center>
    <h5 style="text-align: right;">
        <a href="{{route('admindangxuat')}}">Đăng xuất</a>
    </h5>
    <div class="wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        @if ($errors->any())
                        <h3>{{ $errors->first() }}</h3>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                            {{-- <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending">No.</th> --}}
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">NAME</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">EMAIL</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">VERIFIED</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">IMAGE</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">ADDRESS</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">WEBSITE</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">PHONE</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">TIME CREATE</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">STATUS</th>
                                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1">DO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $rowusers)
                                        <tr class="odd">
                                            {{-- <td class="dtr-control sorting_1" tabindex="0">{{$key+1}}</td> --}}
                                            <td>{{ $rowusers->name }}</td>
                                            <td>{{ $rowusers->email }}</td>
                                            <td>{{ $rowusers->email_verified_at }}</td>
                                            <td><img src="{{ $rowusers->hinhquan }}" width=100px height=100px></td>
                                            <td>{{ $rowusers->diachiquan }}</td>
                                            <td>{{ $rowusers->website }}</td>
                                            <td>{{ $rowusers->sdtquan }}</td>
                                            <td>{{ $rowusers->ngaythanhlap }}</td>
                                            @if ($rowusers->email_verified_at == null)
                                            <td bgcolor="gray">Chưa kích hoạt</td>
                                            @else
                                            <td bgcolor="lightgreen">Đã kích hoạt</td>
                                            @endif

                                            <td>
                                                @if ($rowusers->email_verified_at != null)
                                                <form action="{{route('adminvohieuhoa')}}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$rowusers->id}}">
                                                    <button type="submit" class="btn btn-secondary"><i class="fa fa-times"></i></button>
                                                </form>
                                                @else
                                                <form action="{{route('adminkichhoat')}}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$rowusers->id}}">
                                                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                                                </form>
                                                <form action="{{route('admindelete')}}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$rowusers->id}}">
                                                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
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
            </div>
        </div>
        <h4>
            <div class="float-right d-none d-sm-inline">
                By: Bùi Hữu Châu - Version 1.0
            </div>
            <strong>Luận văn tốt nghiệp 2021. Khóa K43 2017-2021</a>.</strong>
        </h4>
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
    {{-- auto reload --}}
    <script type="text/JavaScript">
        function AutoRefresh( t ) {
		setTimeout("location.reload(true);", t);
	}
</script>


</body>

</html>