<header class="header header-horizontal header-view-pannel">
    <div class="container ">
        <nav class="navbar">
            <a class="navbar-brand" href="<?= BASE_URL ?>">
                <img src="./assets_font/images/logo.jpg" alt="">
            </a>
            <button class="navbar-toggler" type="button">
                <span class="th-dots-active-close th-dots th-bars">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item nav-item-arrow-down nav-hover-show-sub">
                        <a class="nav-link" href="<?= BASE_URL ?>">Trang Chủ</a>
                    </li>
                    <li class="nav-item nav-item-arrow-down nav-hover-show-sub">
                        <a class="nav-link" href="#" data-role="nav-toggler">Phim</a>
                        <div class="nav-arrow"><i class="fas fa-chevron-down"></i></div>
                        <ul class="collapse nav">
                            <?php foreach ($genres as $genre) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= BASE_URL . '?act=movieOfgenre&genre_id=' . $genre['genre_id'] ?>"><?= $genre['name'] ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-arrow-down nav-hover-show-sub">
                        <a class="nav-link" href="movies-blocks.html">Rạp Chiếu</a>
                    </li>
                    <li class="nav-item nav-item-arrow-down nav-hover-show-sub">
                        <a class="nav-link" href="contact-us.html">Liên Hệ</a>
                    </li>
                    <?php if (isset($_SESSION['user']['id'])) { ?>
                        <li class="nav-item nav-item-arrow-down nav-hover-show-sub">
                            <div class="d-flex">
                                <p class="mt-3">Chào, </p>
                                <a class="nav-link mt-2 text-ellipsis" href="#" data-role="nav-toggler" style="font-size: larger; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width:75px;">
                                    <strong><?= $_SESSION['user']['name'] ?></strong>
                                </a>
                            </div>
                            <ul class="collapse nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= BASE_URL . '?act=myAccount' ?>">Thông Tin Cá Nhân</a>
                                    <a class="nav-link" href="<?= BASE_URL . '?act=logout' ?>">Đăng Xuất</a>
                                </li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item nav-item-arrow-down nav-hover-show-sub">
                            <a class="nav-link" href="<?= BASE_URL . '?act=signUp' ?>">Đăng Nhập</a>
                        </li>
                    <?php } ?>
                    <!-- Tìm Kiếm -->
                    <li class="nav-item input-group d-flex align-items-center" style="width: 160px;">
                        <input type="text" class="form-control">
                        <span class="input-group-text" id="basic-addon1"><i style="color: black;" class="fa-solid fa-magnifying-glass"></i></span>
                    </li>
                </ul>
                <div class="navbar-extra">
                    <a class="btn-theme btn" href="<?= BASE_URL . '?act=putMovies' ?>"><i class="fas fa-ticket-alt"></i>&nbsp;&nbsp;Buy Ticket</a>
                </div>
            </div>
        </nav>
    </div>
</header>