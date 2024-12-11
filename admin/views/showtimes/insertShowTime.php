<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERT ShowTimes</title>
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
                        <h1>Insert ShowTimes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Quản Lý Lịch Chiếu Phim</li>
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
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thêm Lịch Chiếu</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="" method="POST">
                                <div class="card-body">
                                    <?php
                                    // Lấy thông báo lỗi từ session
                                    $errors = $_SESSION['errors'] ?? [];
                                    // Xóa thông báo lỗi trong session sau khi hiển thị
                                    unset($_SESSION['errors']);
                                    ?>
                                    <div class="form-group">
                                        <label>Phim Chiếu</label>
                                        <select name="movie" class="form-control" id="">
                                            <option selected disabled>Chọn Phim Chiếu</option>
                                            <?php foreach ($listMovies as $listMovie) {

                                            ?>
                                                <option value="<?= $listMovie['movie_id'] ?>"><?= $listMovie['title'] ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                        <?php if (isset($errors['movie'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['movie']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Rạp Chiếu</label>
                                        <select name="cinema" class="form-control" id="">
                                            <option selected disabled>Chọn Rạp Chiếu</option>
                                            <?php foreach ($listCinemas as $listCinema) {

                                            ?>
                                                <option value="<?= $listCinema['cinema_id'] ?>"><?= $listCinema['name'] ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                        <?php if (isset($errors['cinema'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['cinema']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Màn Hình Chiếu</label>
                                        <select name="screen" class="form-control" id="">
                                            <option selected disabled>Chọn Màn Hình Chiếu</option>
                                            <?php foreach ($listScreens as $listScreen) {

                                            ?>
                                                <option value="<?= $listScreen['screen_id'] ?>"><?= $listScreen['screen_name'] ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                        <?php if (isset($errors['screen'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['screen']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày Chiếu</label>
                                        <input type="date" class="form-control" name="show_date" placeholder="Nhập Ngày Chiếu">
                                        <?php if (isset($errors['show_date'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['show_date']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Giờ Chiếu</label>
                                        <input type="time" class="form-control" name="show_time" placeholder="Nhập Giờ Chiếu">
                                        <?php if (isset($errors['show_time'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['show_time']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng Thái</label>
                                        <select name="status" class="form-control" id="">
                                            <option selected disabled>Chọn Trạng Thái</option>
                                            <option value="1">Sắp Chiếu</option>
                                            <option value="2">Đang Chiếu</option>
                                            <option value="3">Dừng Chiếu</option>
                                            <option value="4">Hết Vé</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
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

</body>

</html>
</body>

</html>