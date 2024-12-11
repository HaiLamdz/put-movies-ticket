<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upadte ShowTimes</title>
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
                        <h1>Upadte ShowTimes</h1>
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
                                <h3 class="card-title">Cập Nhập Lịch Chiếu</h3>
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
                                        <label for="movie">Tên Phim</label>
                                        <select id="movie" name="movie" class="form-control custom-select">
                                            <?php foreach ($listMovies as $listMovie) { ?>
                                                <option <?= $listMovie['movie_id'] == $showTimes['movie_id'] ? 'selected' : '' ?> value="<?= $listMovie['movie_id'] ?>"> <?= $listMovie['title'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cinema">Rạp Chiếu</label>
                                        <select id="cinema" name="cinema" class="form-control custom-select">
                                            <?php foreach ($listCinemas as $listCinema) { ?>
                                                <option <?= $listCinema['cinema_id'] == $showTimes['cinema_id'] ? 'selected' : '' ?> value="<?= $listCinema['cinema_id'] ?>"> <?= $listCinema['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="screen">Màn Hình Chiếu</label>
                                        <select id="screen" name="screen" class="form-control custom-select">
                                            <?php foreach ($listScreens as $listScreen) { ?>
                                                <option <?= $listScreen['screen_id'] == $showTimes['screen_id'] ? 'selected' : '' ?> value="<?= $listScreen['screen_id'] ?>"> <?= $listScreen['screen_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày Chiếu</label>
                                        <input type="date" class="form-control" name="show_date" value="<?= $showTimes['show_date'] ?>">
                                        <?php if (isset($errors['show_date'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['show_date']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Giờ Chiếu</label>
                                        <input type="time" class="form-control" name="show_time" value="<?= $showTimes['show_time'] ?>">
                                        <?php if (isset($errors['show_time'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['show_time']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Trạng Thái sản phẩm</label>
                                        <select id="status" name="status" class="form-control custom-select">
                                            <option <?= $showTimes['status_id'] == 1 ? 'selected' : '' ?> value="1">Sắp Chiếu</option>
                                            <option <?= $showTimes['status_id'] == 2 ? 'selected' : '' ?> value="2">Đang Chiếu</option>
                                            <option <?= $showTimes['status_id'] == 3 ? 'selected' : '' ?> value="3">Dừng Chiếu</option>
                                            <option <?= $showTimes['status_id'] == 4 ? 'selected' : '' ?> value="4">Hết Vé</option>
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