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
                        <h1>Insert Cinemas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Quản Lý Rạp Chiếu Phim</li>
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
                                <h3 class="card-title">Thêm Rạp Chiếu</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <?php
                                    // Lấy thông báo lỗi từ session
                                    $errors = $_SESSION['errors'] ?? [];
                                    // Xóa thông báo lỗi trong session sau khi hiển thị
                                    unset($_SESSION['errors']);
                                    ?>
                                    <div class="form-group">
                                        <label>Tên Rạp Chiếu</label>
                                        <input type="text" class="form-control" name="name" placeholder="Nhập Tên Rạp Chiếu">
                                        <?php if (isset($errors['name'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['name']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh Rạp Chiếu</label>
                                        <input type="file" class="form-control" name="hinhAnh" >
                                        <?php if (isset($errors['hinhAnh'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['hinhAnh']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa Chỉ:</label>
                                        <input type="text" class="form-control" name="address" placeholder="Nhập Địa Chỉ">
                                        <?php if (isset($errors['address'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['address']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Tỉnh / Thành Phố</label>
                                        <input type="text" class="form-control" name="city" placeholder="Nhập Tỉnh / Thành Phố">
                                        <?php if (isset($errors['city'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['city']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Số Điện Thoại</label>
                                        <input type="text" class="form-control" name="phone_number" placeholder="Nhập Số Điện Thoại">
                                        <?php if (isset($errors['phone_number'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['phone_number']  ?></p>
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