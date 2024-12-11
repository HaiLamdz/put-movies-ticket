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
                        <h1>Update Cinemas</h1>
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
                                <h3 class="card-title">Cập Nhập Rạp Chiếu</h3>
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
                                    <input type="text" name="cinema_id" value="<?= $cinema['cinema_id'] ?>" hidden>
                                    <div class="form-group">
                                        <label>Tên Rạp Chiếu</label>
                                        <input type="text" class="form-control" name="name" value="<?= $cinema['name'] ?>">
                                        <?php if (isset($errors['name'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['name']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="Poster">Poster</label><br>
                                        <img id="poster" src="<?= BASE_URL .  $cinema['image_cinema'] ?? "" ?>" alt="Poster" class="img-fluid " style="width: 140px;">
                                        <input type="file" class="form-control mt-2" id="changePoster" name="hinhAnh">
                                    </div>
                                    <div class="form-group">
                                        <label>Địa Chỉ:</label>
                                        <input type="text" class="form-control" name="address" value="<?= $cinema['address'] ?>">
                                        <?php if (isset($errors['address'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['address']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Tỉnh / Thành Phố</label>
                                        <input type="text" class="form-control" name="city" value="<?= $cinema['city'] ?>">
                                        <?php if (isset($errors['city'])) {
                                        ?>
                                            <p class="text-danger"><?= $errors['city']  ?></p>
                                        <?php
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Số Điện Thoại</label>
                                        <input type="text" class="form-control" name="phone_number" value="<?= $cinema['phone_number'] ?>">
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