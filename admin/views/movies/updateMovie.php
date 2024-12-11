<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
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
                    <div class="col-sm-12">
                        <h1>Update Phim: <strong><?= $movies['title'] ?></strong></h1>
                        <br>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông Tin Phim</h3>
                            <div class="card-tools">
                                <hr>
                            </div>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?= $movies['movie_id'] ?>">
                                    <label for="title">Tên Phim</label>
                                    <input type="text" id="inputName" name="title" class="form-control" value="<?= $movies['title'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="Poster">Poster</label><br>
                                    <img id="poster" src="<?= BASE_URL .  $movies['poster_url'] ?>" alt="Poster" class="img-fluid " style="width: 140px;">
                                    <input type="file" class="form-control mt-2" id="changePoster" name="poster">
                                </div>
                                <div class="form-group">
                                    <label for="danh_muc_id">Thể Loại</label>
                                    <select id="genre" name="genre" class="form-control custom-select">
                                        <?php foreach ($genres as $genre) { ?>
                                            <option <?= $genre['genre_id'] == $movies['genre'] ? 'selected' : '' ?> value="<?= $genre['genre_id'] ?>"> <?= $genre['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status_id">Trạng Thái</label>
                                    <select id="status_id" name="status" class="form-control custom-select">
                                        <option <?= $movies['status_id'] == 1 ? 'selected' : '' ?> value="1">Đang Chiếu</option>
                                        <option <?= $movies['status_id'] == 2 ? 'selected' : '' ?> value="2">Dừng Chiếu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Mô Tả</label>
                                    <textarea id="inputName" style="height: 80px;" name="description" class="form-control" value=""><?= $movies['description'] ?></textarea>
                                </div>
                            </div>

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary">Sửa Thông Tin</button>
                            </div>
                        </form>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-4">

                    <!-- /.card -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Trailer</h3>
                            <div class="card-tools">
                                <hr>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <form action="<?= BASE_URL_ADMIN . '?act=updateTrailer' ?>" method="POST" enctype="multipart/form-data">
                                <div class="table-responsive">
                                    <table id="faqs" class="table table-hover">
                                        <tbody>
                                            <input type="hidden" name="movie_id" value="<?= $movies['movie_id'] ?>">
                                            <iframe style="margin-left: 23px;" width="400" height="250" src="<?= $movies['trailer_url'] ?>" title="VENOM: KÈO CUỐI - Trailer | KC: 25.10.2024" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                            <input style="width: 90%; margin-left: 23px;" type="text" class="form-control mt-2" id="changeTrailer" name="trailer" placeholder="New Trailer...">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary">Sửa Thông Tin</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <a href="<?= BASE_URL_ADMIN . '?act=sanpham' ?>"><input type="submit" value="Save Changes" class="btn btn-success float-right"></a>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- // footer -->
    <?php require_once './views/layout/footer.php' ?>

</body>
<script>
    // update Ảnh
    const poster = document.querySelector('#poster');
    const changePoster = document.querySelector('#changePoster');

    changePoster.addEventListener("change", () => {
        poster.src = URL.createObjectURL(changePoster.files[0])
    })

    // console.log(img)

    var faqs_row = <?= count($listAnhSanPham) ?>;
</script>

</html>
</body>

</html>