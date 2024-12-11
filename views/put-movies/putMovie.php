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

    <div class="section-pannel container mt-5">
        <div class="grid row">
            <div class="col-md-10">
                    <div class="d-flex form-grid">
                        <div class="col-sm-6 col-lg-3">
                            <h3 class="mt-1 " style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">ĐẶT VÉ NHANH</h3>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="input-view-flat input-group">
                                <select id="cinemaSelect" onchange="loadMovies()" class="form-control " name="cinema_id">
                                    <option selected>Chọn Rạp Chiếu</option>
                                    <?php foreach ($listCinemas as $listCinema) { ?>
                                        <option value="<?= $listCinema['cinema_id'] ?>"><?= $listCinema['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="input-view-flat input-group">
                                <select id="movieSelect" onchange="loadShowtimes()" class="form-control" name="movie_id" disabled>
                                    <option>Chọn Phim Chiếu</option>
                                    <?php foreach ($getMovies as $getMovie) { ?>
                                        <option value="<?= $getMovie['movie_id'] ?>"><?= $getMovie['title'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="input-view-flat input-group">
                                <select id="showtimeSelect" style="color: white;" class="form-control" name="showtime_id" disabled>
                                    <option>Chọn Ca Chiếu</option>
                                    <?php foreach ($showtimes as $showtime) { ?>
                                        <option value="<?= $showtime['showtime_id'] ?>"><?= $showtime['show_time'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="input-group">
                                <button class="btn-theme btn" type="submit" id="putMovieNow"><i class="fas fa-ticket-alt"></i>ĐẶt Vé</button>
                            </div>
                        </div>

                    </div>
            </div>

        </div>
    </div>

    <?php require_once './views/layout/footer.php' ?>
</body>
<script>
    const BASE_URL = "<?= 'http://localhost:81/put_movies/put_movies_ticket/' ?>";

    function loadMovies() {
        const cinemaId = document.getElementById("cinemaSelect").value;
        // console.log(BASE_URL);
        // Lấy ID của rạp được chọn
        const movieSelect = document.getElementById("movieSelect"); // Lấy phần tử select của phim

        // Xóa các tùy chọn hiện có trong movieSelect và reset showtimeSelect
        movieSelect.innerHTML = '<option value="">Chọn Phim Chiếu</option>';
        document.getElementById("showtimeSelect").innerHTML = '<option value="">Chọn Ca Chiếu</option>';
        document.getElementById("showtimeSelect").disabled = true; // Vô hiệu hóa showtimeSelect

        // Kiểm tra nếu có rạp chiếu được chọn, tiến hành fetch dữ liệu
        if (cinemaId) {
            // console.log(cinemaId);
            fetch(`${ BASE_URL }?act=getMovies&cinema_id=${cinemaId}`) // Gửi yêu cầu đến getMovies.php với tham số cinema_id
                .then(response => response.json()) // Nhận phản hồi và chuyển nó thành JSON
                .then(data => {
                    console.log(data);

                    data.forEach(movie => { // Lặp qua từng phim trong danh sách trả về
                        const option = document.createElement("option"); // Tạo thẻ option cho mỗi phim
                        option.value = movie.movie_id; // Gán movie_id làm giá trị của option
                        option.textContent = movie.title; // Gán tên phim làm nội dung hiển thị
                        movieSelect.appendChild(option); // Thêm option vào movieSelect
                    });
                    movieSelect.disabled = false; // Kích hoạt movieSelect
                });
        } else {
            movieSelect.disabled = true; // Vô hiệu hóa movieSelect nếu chưa chọn rạp
        }
    }

    function loadShowtimes() {
        const cinemaId = document.getElementById("cinemaSelect").value; // Lấy ID của rạp
        const movieId = document.getElementById("movieSelect").value; // Lấy ID của phim
        const showtimeSelect = document.getElementById("showtimeSelect"); // Lấy phần tử select của ca chiếu
        // console.log(cinemaId, movieId);

        // Xóa các tùy chọn hiện có trong showtimeSelect
        showtimeSelect.innerHTML = '<option value="">Chọn Ca Chiếu</option>';

        // Kiểm tra nếu cả rạp chiếu và phim đều được chọn, fetch dữ liệu
        if (cinemaId && movieId) {
            // console.log(cinemaId, movieId);
            fetch(`${ BASE_URL }?act=showtimes&cinema_id=${cinemaId}&movie_id=${movieId}`) // Gửi yêu cầu đến getShowtimes.php với cinema_id và movie_id
                .then(response => response.json()) // Nhận phản hồi và chuyển thành JSON
                .then(data => {
                    console.log(data);

                    data.forEach(showtime => { // Lặp qua từng ca chiếu trong danh sách trả về
                        const option = document.createElement("option"); // Tạo thẻ option cho mỗi ca chiếu
                        option.value = showtime.showtime_id; // Gán showtime_id làm giá trị của option
                        option.textContent = showtime.show_time; // Gán thời gian của ca chiếu làm nội dung hiển thị
                        showtimeSelect.appendChild(option); // Thêm option vào showtimeSelect
                    });
                    showtimeSelect.disabled = false; // Kích hoạt showtimeSelect khi có dữ liệu ca chiếu
                });
        } else {
            showtimeSelect.disabled = true; // Vô hiệu hóa showtimeSelect nếu chưa chọn cả rạp và phim
        }

    }
    document.getElementById("showtimeSelect").addEventListener("change", function() {
        const showtimeId = this.value; // Lấy showtime_id khi người dùng chọn ca chiếu
        const selectedOption = this.options[this.selectedIndex]; // Lấy option đang được chọn
        const showtime = selectedOption.text; // Lấy nội dung giờ chiếu
        console.log("ID của ca chiếu đã chọn: " + showtimeId);
        console.log("ca chiếu đã chọn: " + showtime);
    });

    $("#putMovieNow").on('click' , function () { 
        const cinema_id = document.getElementById("cinemaSelect").value;
        const movie_id = document.getElementById("movieSelect").value;
        const showtime_id = document.getElementById("showtimeSelect").value;

        console.log(cinema_id, movie_id, showtime_id);

        if(cinema_id && movie_id && showtime_id){
            window.location.href = `${BASE_URL}?act=putMovieNow&cinema_id=${cinema_id}&movie_id=${movie_id}&showtime_id=${showtime_id}`;
        }else{
            console.log('Xin Mời Chọn Thông Tin');
        }
    });

    
</script>

</html>