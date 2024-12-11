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
        <div class="col-md-10">

            <div class="card card-danger" style="min-height: 900px;">
                <div class="card-header">
                    <h3 class="card-title">Thêm Phim</h3>
                </div>
                <form action="  " method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <!-- Date dd/mm/yyyy -->
                        <div class="form-group">
                            <label>Tên Phim</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <!-- /.input group -->
                        </div>

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Mô Tả Phim</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <textarea name="mota" class="form-control" id=""></textarea>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Thể Loại Phim</label>
                            <select name="theLoai" class="form-control" id="">
                                <option selected disabled>Chọn Thể Loại Phim</option>
                                <?php foreach ($genres as $genre) {

                                ?>
                                    <option value="<?= $genre['genre_id'] ?>"><?= $genre['name'] ?></option>
                                <?php
                                } ?>
                            </select>
                            <?php if (isset($errors['theLoai'])) {
                            ?>
                                <p class="text-danger"><?= $errors['theLoai']  ?></p>
                            <?php
                            } ?>
                        </div>
                        <!-- /.form group -->

                        <!-- IP mask -->
                        <div class="form-group">
                            <label>Thời Lượng</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                                </div>
                                <input type="time" name="thoiLuong" class="form-control">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Ngaỳ Phát Hành</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                                </div>
                                <input type="Date" name="ngayPhatHanh" class="form-control">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Hình Ảnh</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                                </div>
                                <input type="file" name="hinhAnh" class="form-control">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Demo Phim</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                                </div>
                                <input type="text" name="trailer" class="form-control">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Đạo Diễn</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                                </div>
                                <input type="text" name="daoDien" class="form-control">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Diễn Phim Chính</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                                </div>
                                <input type="text" name="dienVien" class="form-control">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Trang Thai</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                                </div>
                                <input type="text" name="trangThai" class="form-control">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-secondary float-right rounded">Thêm</button>
                        </div>
                        <!-- /.form group -->

                    </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <?php require_once './views/layout/footer.php' ?>
</body>

</html>