<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
</head>

<body>
    <?php require_once './views/layout/header.php' ?>
    <?php require_once './views/layout/nav.php' ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-9 max-w-4xl mx-auto p-4 ">
                <div class="col-12 bg-white rounded shadow p-4" style="min-height: auto;">
                    <h4>Hồ Sơ Của Tôi</h4>
                    <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                    <form method="POST" action="<?= BASE_URL . '?act=update_Account' ?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Tên -->
                                <div class="form-group mb-3">
                                    <label for="name">Tên Đăng Nhập</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="<?= $Account['name'] ?? 'Nhập tên của bạn' ?>">
                                </div>

                                <!-- Email -->
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?= $Account['email'] ?>" disabled>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="phone">So Dien Thoai</label>
                                    <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="<?= $Account['phone_number'] ?? 'Cap nhap so dien thoai..' ?>">
                                </div>
                            </div>

                            <!-- Hình đại diện -->
                            <div class="col-md-4 text-center">
                                <label for="avata">Ảnh đại diện</label><br>
                                <img id="img" src="<?= $Account['avata'] ?? 'https://via.placeholder.com/150' ?>" alt="avata" class="img-fluid rounded-circle mb-3" style="width: 150px;">
                                <input type="file" class="form-control" id="input" name="avata">
                                <p class="mt-2">Dung lượng file tối đa 1 MB<br>Định dạng: JPEG, PNG</p>
                            </div>
                        </div>

                        <!-- Nút Lưu -->
                        <div class="form-group text-center mt-4">
                            <button class="btn btn-secondary" style=" width: 120px;" type="submit">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require_once './views/layout/footer.php' ?>
</body>
<script>
    const img = document.querySelector('#img');
    const input = document.querySelector('#input');

    input.addEventListener("change", () => {
        img.src = URL.createObjectURL(input.files[0])
    })
</script>

</html>