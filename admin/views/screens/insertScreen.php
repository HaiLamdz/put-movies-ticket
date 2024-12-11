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
                        <h1>Insert Screens</h1>
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
                                <h3 class="card-title">Thêm Màn Hình Chiếu</h3>
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
                                        <label>Tên Màn Hình Chiếu</label>
                                        <input type="text" class="form-control" name="screen" placeholder="Nhập Tên Màn Hình Chiếu">
                                        <?php if (isset($errors['screen'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['screen']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Số Lượng Ghế:</label>
                                        <input type="text" class="form-control" name="seat" placeholder="Nhập Số Lượng Ghế">
                                        <?php if (isset($errors['seat'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['seat']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Rạp Chiếu</label>
                                        <input type="text" class="form-control" name="cinema" placeholder="Nhập Rạp Chiếu">
                                        <?php if (isset($errors['cinema'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['cinema']  ?></p>
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