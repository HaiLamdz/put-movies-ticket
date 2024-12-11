<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
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
        font-weight: bold;
        text-align: center;
        margin-top: 30px;
    }

    .seat {
        width: 50px;
        height: 50px;
        background-color: #f0f0f0;
        margin-right: 5px;
        text-align: center;
        line-height: 30px;
        border-radius: 5px;
        cursor: pointer;
        margin: 20px;
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

    .legend-item>.box {
        width: 20px;
        height: 20px;
        border-radius: 3px;
    }
</style>

<body>
    <?php require_once './views/layout/header.php' ?>
    <?php require_once './views/layout/nav.php' ?>

    <!--  -->

    <div class="container">
        <div class="sidebar-container">
            <div class="content">
                <section class="section-long">
                    <div class="section-line">
                        <div class="movie-info-entity">
                            <div class="entity-poster" data-role="hover-wrap">
                                <div class="embed-responsive embed-responsive-poster">
                                    <img class="embed-responsive-item" src="<?= $detailMovies['poster_url'] ?>" alt="" />
                                </div>
                            </div>
                            <div class="entity-content mt-5">
                                <h2 class="entity-title"><?= $detailMovies['title'] ?></h2>
                                <div class="entity-category">
                                    <a class="content-link" href="movies-blocks.html"><?= $detailMovies['name'] ?></a>
                                </div>
                                <div class="entity-info">
                                    <div class="info-lines">
                                        <div class="info info-short">
                                            <span class="text-theme info-icon"><i class="fas fa-star"></i></span>
                                            <span class="info-text">8,7</span>
                                            <span class="info-rest">/10</span>
                                        </div>
                                        <div class="info info-short">
                                            <span class="text-theme info-icon"><i class="fas fa-clock"></i></span>
                                            <span class="info-text"><?= $detailMovies['duration'] ?></span>
                                            <span class="info-rest">&nbsp;Giờ</span>
                                        </div>
                                    </div>
                                </div>
                                <ul class="entity-list">
                                    <li>
                                        <span class="entity-list-title">Ngày Phát Hành:</span><?= formartDate($detailMovies['release_date']) ?>
                                    </li>
                                    <li>
                                        <span class="entity-list-title">Đạo Diễn:</span>
                                        <a class="content-link" href="#"><?= $detailMovies['director'] ?></a>
                                    </li>
                                    <li>
                                        <span class="entity-list-title">Diễn viên:</span>
                                        <a class="content-link" href="#"><?= $detailMovies['cast'] ?>...</a>
                                    </li>
                                    <li>
                                        <span class="entity-list-title">Nội Dung:</span>
                                        <a class="content-link" href="#"><?= $detailMovies['description'] ?></a>
                                    </li>
                                    <li>
                                        <a href="" id="trailerLink" class="trailer-button">
                                            <div class="play-icon"></div>
                                            <div class="trailer-text">Xem Trailer</div>
                                        </a>
                                        <div id="overlay" style="display: none;"></div>
                                        <div id="trailerContainer" style="display: none; margin-top: 10px;">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <h2 class="text-center">Đặt Ghế</h2>
                    <select class="form-select" name="screen" id="screen-select">
                        <option value="">Chọn Màn Hình Chiếu</option>
                        <?php foreach ($listScreens as $listScreen): ?>
                            <option value="<?= $listScreen['screen_id'] ?>"><?= $listScreen['screen_name'] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <div class="seat-map" id="seat-map"></div>
                </section>
            </div>
        </div>
    </div>
    <a class="scroll-top disabled" href="#"><i class="fas fa-angle-up" aria-hidden="true"></i></a>
    </div>
    </div>

    <!--  -->
    <?php require_once './views/layout/footer.php' ?>
</body>
<script>
    const breadcrumbs = document.getElementById('breadcrumbs');
    const path = window.location.pathname.split('/').filter(Boolean).slice(1); // Bỏ thư mục dự án
    let fullPath = '';

    path.forEach((segment, index) => {
        fullPath += `/${segment}`;
        const label = segment.replace(/[-_]/g, ' ').charAt(0).toUpperCase() + segment.slice(1);
        const link = `<a class="content-link" href="${fullPath}">${label}</a>`;
        breadcrumbs.innerHTML += link;
        if (index < path.length - 1) {
            breadcrumbs.innerHTML += `<span class="text-theme mx-2"><i class="fas fa-chevron-right"></i></span>`;
        }
    });
</script>
<script>
    const BASE_URL = `http://localhost:81/put_movies/put_movies_ticket/`;
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
        fetch(`${BASE_URL}?act=seats&screen_id=${screenId}`) // Truyền tham số màn hình
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

</html>