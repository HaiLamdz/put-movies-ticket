<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Times</title>
</head>

<body>
    <?php require_once './views/layout/header.php' ?>
    <?php require_once './views/layout/navbar.php' ?>
    <?php require_once './views/layout/sidebar.php' ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ShowTimes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Quản Lý Lịch Chiếu Phim </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->

                        <div class="card">
                            <div class="d-flex">
                                <div class="card-header">
                                    <a href="<?= BASE_URL_ADMIN . '?act=insertShowTimes' ?>"><button class="btn btn-success">Thêm Lịch Chiếu Phim</button></a>
                                </div>
                                <div class="card-header">
                                    <a href="<?= BASE_URL_ADMIN . '?act=insertShowTimeAutos' ?>"><button onclick="return confirm('Bạn Muốn Thêm Lịch Chiếu Tự Động Chứ')" class="btn btn-danger">Thêm Lịch Chiếu Phim Tự Động</button></a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên Phim</th>
                                            <th>Rạp Chiếu</th>
                                            <th>Màn Hình Chiếu</th>
                                            <th>Ngày Chiếu</th>
                                            <th>Giờ Chiếu</th>
                                            <th>Trạng Thái</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listShowTimes as $key => $row) {
                                        ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $row['title'] ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['screen_name'] ?></td>
                                                <td><?= formartDate($row['show_date']) ?></td>
                                                <td><?= $row['show_time'] ?></td>
                                                <td><?= $row['name_status_showtime'] ?></td>
                                                <td>
                                                    <a href="<?= BASE_URL_ADMIN . '?act=updateShowTimes&showtime_id=' . $row['showtime_id'] ?>"><button class="btn btn-warning">Sửa</button></a>

                                                    <a onclick="return confirm('Bạn có muốn xóa Lịch chiếu này không??')" href="<?= BASE_URL_ADMIN . '?act=deleteShowTimes&showtime_id=' . $row['showtime_id'] ?>"><button class="btn btn-warning">xóa</button></a>
                                                </td>
                                            </tr>
                                        <?php } ?>


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên Phim</th>
                                            <th>Rạp Chiếu</th>
                                            <th>Màn Hình Chiếu</th>
                                            <th>Ngày Chiếu</th>
                                            <th>Giờ Chiếu</th>
                                            <th>Trạng Thái</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- // footer -->
    <?php require_once "./views/layout/footer.php" ?>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <!-- Code injected by live-server -->
    <script>
        // <![CDATA[  <-- For SVG support
        if ('WebSocket' in window) {
            (function() {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
                        }
                        parent.appendChild(elem);
                    }
                }
                var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                var address = protocol + window.location.host + window.location.pathname + '/ws';
                var socket = new WebSocket(address);
                socket.onmessage = function(msg) {
                    if (msg.data == 'reload') window.location.reload();
                    else if (msg.data == 'refreshcss') refreshCSS();
                };
                if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                    console.log('Live reload enabled.');
                    sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                }
            })();
        } else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
        // ]]>
    </script>
</body>

</html>
</body>

</html>