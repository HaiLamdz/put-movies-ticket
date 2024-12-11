<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERT GENRE</title>
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
                        <h1>Update Screens</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Quản Lý Màn Chiếu Phim</li>
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
                                <h3 class="card-title">Cập Nhập Rạp Màn Hình Chiếu</h3>
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
                                    <input type="text" name="screen_id" value="<?= $screen['screen_id'] ?>" hidden>
                                    <div class="form-group">
                                        <label>Tên Rạp Chiếu</label>
                                        <input type="text" class="form-control" name="screen_name" value="<?= $screen['screen_name'] ?>">
                                        <?php if (isset($errors['screen_name'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['screen_name']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa Chỉ:</label>
                                        <input type="text" class="form-control" name="seat_capacity" value="<?= $screen['seat_capacity'] ?>">
                                        <?php if (isset($errors['seat_capacity'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['seat_capacity']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Tỉnh / Thành Phố</label>
                                        <input type="text" class="form-control" name="cinema_id" value="<?= $screen['cinema_id'] ?>">
                                        <?php if (isset($errors['cinema_id'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['cinema_id']  ?></p>
                                        <?php
                                        } ?>
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