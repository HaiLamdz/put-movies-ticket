<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genre</title>
</head>
<style>
    #seat-map {
        display: flex;
        flex-direction: column;
        /* Xếp các hàng ghế theo chiều dọc */
        margin-top: 20px;
    }

    .seat-row {
        display: flex;
        justify-content: center;
        /* Xếp các ghế trong hàng theo chiều ngang */
        margin-bottom: 10px;
    }

    .row-label {
        width: 30px;
        /* Điều chỉnh kích thước nhãn hàng */
        margin-right: 10px;
        font-weight: bold;
        text-align: center;
    }

    .seat {
        width: 30px;
        height: 30px;
        background-color: #f0f0f0;
        margin-right: 5px;
        text-align: center;
        line-height: 30px;
        border-radius: 5px;
        cursor: pointer;
    }

    .seat.standard {
        background-color: #4CAF50;
        /* Màu cho ghế thường */
    }

    .seat.vip {
        background-color: #FFD700;
        /* Màu vàng cho ghế VIP */
    }

    .seat.occupied {
        background-color: #e6e6e6;
        /* Màu cho ghế đã chọn */
    }

    .legend {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .legend-item > .box {
        width: 20px;
        height: 20px;
        border-radius: 3px;
    }
</style>

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
                        <h1>Screens</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Quản Lý Màn Hình Rạp Chiếu Phim </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-7">
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <a href="<?= BASE_URL_ADMIN . '?act=insertScreens' ?>"><button class="btn btn-success">Thêm Màn Hình </button></a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên Màn Hình</th>
                                            <th>Số Lượng Ghế</th>
                                            <th>Rạp Chiếu</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listScreens as $key => $row) {
                                        ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $row['screen_name'] ?></td>
                                                <td><?= $row['seat_capacity'] ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td>
                                                    <a href="<?= BASE_URL_ADMIN . '?act=updateScreens&screen_id=' . $row['screen_id'] ?>"><button class="btn btn-warning">Sửa</button></a>

                                                    <a onclick="return confirm('Bạn có muốn xóa rạp phim này không??')" href="<?= BASE_URL_ADMIN . '?act=deleteScreens&screen_id=' . $row['cinema_id'] ?>"><button class="btn btn-warning">xóa</button></a>
                                                </td>
                                            </tr>
                                        <?php } ?>


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên Màn Hình</th>
                                            <th>Số Lượng Ghế</th>
                                            <th>Rạp Chiếu</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-5">
                        <div class="card">
                            <div class="card-body">
                                <h4>Quản Lý Ghế</h4>
                                <select class="form-select" name="screen" id="screen-select">
                                    <option value="">Chọn Màn Hình Chiếu</option>
                                    <?php foreach ($listScreens as $listScreen): ?>
                                        <option value="<?= $listScreen['screen_id'] ?>"><?= $listScreen['screen_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <!-- Nơi hiển thị danh sách ghế -->
                                <div class="seat-map" id="seat-map"></div>
                                <div class="legend">
                                    <div class="legend-item">
                                        <div class="box" style="background-color: #e6e6e6;"></div> Ghế đã đặt
                                    </div>
                                    <div class="legend-item">
                                        <div class="box" style="background-color: #FFD700;"></div> Ghế VIP
                                    </div>
                                    <div class="legend-item">
                                        <div class="box" style="background-color: #4CAF50;"></div> Ghế thường
                                    </div>
                                </div>
                            </div>
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
    <script>
        const BASE_URL_ADMIN = `http://localhost:81/put_movies/put_movies_ticket/admin/`;
        // Khi thay đổi lựa chọn màn hình
        document.getElementById('screen-select').addEventListener('change', function() {
            var screenId = this.value;
            console.log(screenId);

            if (screenId) {
                // Gửi AJAX để lấy dữ liệu ghế cho màn hình đã chọn
                fetchSeats(screenId);
            } else {
                // Nếu không chọn màn hình, xóa các ghế hiển thị
                document.getElementById('seat-map').innerHTML = '';
            }
        });

        function fetchSeats(screenId) {
            fetch(`${BASE_URL_ADMIN}?act=seats&screen_id=${screenId}`) // Truyền tham số màn hình
                .then(response => response.json()) // Nhận dữ liệu dạng JSON từ server
                .then(data => {

                    if (Array.isArray(data) && data.length > 0) {
                        console.log(data);
                        // Nếu có ghế, hiển thị chúng
                        displaySeats(data);
                    } else {
                        // Nếu không có ghế, thông báo
                        document.getElementById('seat-map').innerHTML = 'Không có ghế cho màn hình này.';
                    }
                })
                .catch(error => {
                    console.error('Lỗi khi tải ghế:', error);
                    document.getElementById('seat-map').innerHTML = 'Đã có lỗi khi tải ghế.';
                });
        }

        function displaySeats(seats) {
            const seatMap = document.getElementById('seat-map');
            seatMap.innerHTML = ''; // Clear existing content

            // Lặp qua từng ghế trong dữ liệu
            const rows = {}; // Một đối tượng để nhóm ghế theo hàng
            seats.forEach(seat => {
                if (!rows[seat.row]) {
                    rows[seat.row] = [];
                }
                rows[seat.row].push(seat); // Nhóm ghế theo hàng
            });

            // Lặp qua từng hàng ghế (row)
            Object.keys(rows).forEach(row => {
                const rowDiv = document.createElement('div');
                rowDiv.classList.add('seat-row'); // Tạo div cho mỗi hàng ghế

                const rowLabel = document.createElement('div');
                rowLabel.classList.add('row-label');
                rowLabel.textContent = row; // Đặt tên hàng, ví dụ: "A", "B"

                rowDiv.appendChild(rowLabel); // Thêm nhãn hàng vào hàng

                // Lặp qua từng ghế trong hàng
                rows[row].forEach(seat => {
                    const seatDiv = document.createElement('div');
                    seatDiv.classList.add('seat');
                    seatDiv.textContent = seat.row + seat.number; // Hiển thị số ghế

                    // Màu sắc theo trạng thái ghế
                    if (seat.seat_type === 'standard' && seat.seat_status_id === 1) {
                        seatDiv.classList.add('standard'); // Ghế thường
                    } else if (seat.seat_type === 'VIP' && seat.seat_status_id === 1) {
                        seatDiv.classList.add('vip'); // Ghế VIP
                    } else if (seat.seat_type === 'standard' && seat.seat_type === 'VIP' && seat.seat_status_id === 2) {
                        seatDiv.classList.add('occupied');
                    }


                    rowDiv.appendChild(seatDiv);
                });

                seatMap.appendChild(rowDiv); // Thêm hàng ghế vào bản đồ ghế
            });
        }
    </script>

</body>

</html>
</body>

</html>