<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERT MOVIES</title>
</head>
<body>
    <?php require_once './views/layout/header.php' ?>
    <?php require_once './views/layout/navbar.php' ?>
    <?php require_once './views/layout/sidebar.php' ?>
    <div class="row">
        <div class="col-md-12">
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Quản lý danh sách sản phẩm</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active">Quản lý danh sách sản phẩm</li>
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
                                    <div class="card-header">
                                        <a href="<?= BASE_URL_ADMIN . '?act=insertMovies' ?>"><button class="btn btn-success">Thêm Phim</button></a>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Tên Phim</th>
                                                    <th>Thời Lượng Phim</th>
                                                    <th>Ngày Phát Hành</th>
                                                    <th>Ảnh Phim</th>
                                                    <th>Thể Loại</th>
                                                    <th>Đạo Diễn</th>
                                                    <th>Diễn Viên</th>
                                                    <th>Tạng Thái</th>
                                                    <th>Thao Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                <?php foreach ($listMovie as $key => $movies) {
                                                ?>
                                                    <tr>
                                                        <td><?= ++$key ?></td>
                                                        <td><?= $movies['title'] ?></td>
                                                        <td><?= $movies['duration'] ?></td>
                                                        <td><?= formartDate($movies['release_date']) ?></td>
                                                        <td>
                                                            <img src="<?= BASE_URL . $movies['poster_url'] ?>" style="width: 100px; height: 130px;" alt="">
                                                        </td>
                                                        <td><?= $movies['genre'] ?></td>
                                                        <td><?= $movies['director'] ?></td>
                                                        <td> <?= str_replace(',', '<br>', $movies['cast']) ?></td>
                                                        <td><?= $movies['status']?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="<?= BASE_URL_ADMIN . '?act=detailMovies&movie_id=' . $movies['movie_id'] ?>"><button class="btn btn-primary">Chi Tiết</button></a>
                                                                <a href="<?= BASE_URL_ADMIN . '?act=updateMovies&movie_id=' . $movies['movie_id'] ?>"><button class="btn btn-warning">Sửa</button></a>
                                                                <a onclick="return confirm('Bạn có muốn xóa sản phẩm không??')" href="<?= BASE_URL_ADMIN . '?act=deleteMovies&movie_id=' . $movies['movie_id'] ?>"><button class="btn btn-warning">xóa</button></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Tên Phim</th>
                                                    <th>Thời Lượng Phim</th>
                                                    <th>Ngày Phát Hành</th>
                                                    <th>Ảnh Phimn</th>
                                                    <th>Trailer</th>
                                                    <th>Đạo diễn</th>
                                                    <th>Diễn viên</th>
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
            <!-- /.card -->
</body>

</html>