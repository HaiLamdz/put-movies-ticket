<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
</head>
<style>
    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        /* Màu nền mờ */
        display: none;
        z-index: 999;
        /* Đưa overlay lên trên cùng */
    }

    #trailerContainer {
        position: fixed;
        top: 50%;
        left: 60%;
        transform: translate(-50%, -50%);
        /* Giữa trang */
        z-index: 1000;
        /* Đưa video lên trên overlay */
    }
</style>

<body>
    <?php require_once './views/layout/header.php' ?>
    <?php require_once './views/layout/navbar.php' ?>
    <?php require_once './views/layout/sidebar.php' ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 mt-5" >
                        <h1><?= $movies['title'] ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item "><a class="btn btn-secondary" href="<?= BASE_URL_ADMIN . '?act=sanpham' ?>">Home</a></li>
                            <li class="breadcrumb-item active">Quản lý danh sách sản phẩm</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <form action="<?= BASE_URL_ADMIN . '?act=anComment' ?>" method="POST">
            <input type="hidden" name="id_SP" value="<?= $movies['movie_id'] ?>">
        </form>
        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-solid mt-3" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div align="center" class="col-12">
                                <img src="<?= BASE_URL . $movies['poster_url'] ?>" class="product-image" style="width: auto; height: 600px;" alt="Product Image">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h2  class="my-3 fw-bold text-black"> <?= $movies['title'] ?></h2>


                            <hr>
                            <h4 class="mt-3">Thể Loại: <small><?= $movies['name'] ?></small></h4>
                            <h4 class="mt-3">Thời Lượng: <small><?= $movies['duration'] ?></small></h4>
                            <h4 class="mt-3">Mô Tả: <small><?= $movies['description'] ?></small></h4>
                            <h4 class="mt-3">Đạo Diễn: <small><?= $movies['director'] ?></small></h4>
                            <h4 class="mt-3">Diễn Viên: <small><?= $movies['cast'] ?></small></h4>
                            <h4 class="mt-3">Trạng Thái: <small><?= $movies['status_id'] == 1 ? 'Đang Chiếu' : 'Dừng Chiếu' ?></small></h4>
                            <a href="#" id="trailerLink" >
                                <h4 class="mt-5 ms-2"><i class="fa-regular fa-circle-play"></i>   Xem Trailer</h4>
                                <hr style="width: 140px; margin-left: 20px;">
                            </a>
                            <div id="overlay" style="display: none;"></div>
                            <div id="trailerContainer" style="display: none; margin-top: 10px;">

                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- // footer -->
    <?php require_once './views/layout/footer.php' ?>
    <script>
        $(document).ready(function() {
            $('.product-image-thumb').on('click', function() {
                var $image_element = $(this).find('img')
                $('.product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')
            })
        })
    </script>

    <script>
        const trailerLink = document.getElementById('trailerLink');
        const trailerContainer = document.getElementById('trailerContainer');
        const overlay = document.getElementById('overlay');

        // Đặt trailer_url từ PHP vào một biến JavaScript
        const trailerUrl = '<iframe width="900" height="500" src="<?= $movies['trailer_url'] ?>" title="VENOM: KÈO CUỐI - Trailer | KC: 25.10.2024" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'; // đảm bảo giá trị này là một URL hợp lệ

        $(trailerLink).click(function(e) {
            e.preventDefault();

            // Hiển thị overlay và video
            overlay.style.display = "block";
            trailerContainer.innerHTML = trailerUrl;
            trailerContainer.style.display = "block";

        });

        // Thêm sự kiện cho overlay để ẩn video và overlay
        overlay.onclick = function() {
            overlay.style.display = "none"; // Ẩn overlay
            trailerContainer.innerHTML = ""; // Dừng video
            trailerContainer.style.display = "none"; // Ẩn video container
        };
    </script>

</body>

</html>
</body>

</html>