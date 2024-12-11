<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>

<body>
    <?php require_once './views/layout/header.php' ?>
    <?php require_once './views/layout/nav.php' ?>
    <section class="section-text-white position-relative">
        <div class="d-background" data-image-src="http://via.placeholder.com/1920x1080" data-parallax="scroll"></div>
        <div class="d-background bg-theme-blacked"></div>
        <div class="mt-auto container position-relative">
            <div class="top-block-head text-uppercase">
                <h2 class="display-4">Phim
                    <span class="text-theme">Đang Chiếu</span>
                </h2>
            </div>
            <div class="top-block-footer">
                <div class="slick-spaced slick-carousel" data-slick-view="navigation responsive-4">
                    <div class="slick-slides">
                        <?php foreach ($listMovie as $movie) { ?>
                            <div class="slick-slide">
                                <article class="poster-entity" data-role="hover-wrap">
                                    <div class="embed-responsive embed-responsive-poster">
                                        <img class="embed-responsive-item" src="<?= $movie['poster_url'] ?>" alt="" />
                                    </div>
                                    <div class="d-background bg-theme-lighted collapse animated faster" data-show-class="fadeIn show" data-hide-class="fadeOut show"></div>
                                    <div class="d-over bg-highlight-bottom">
                                        <div class="collapse animated faster entity-play" data-show-class="fadeIn show" data-hide-class="fadeOut show">
                                            <a class="action-icon-theme action-icon-bordered rounded-circle" data-fancybox href="<?= $movie['trailer_url'] ?>" data-caption="Trailer of <?= $movie['title'] ?>">
                                                <span class="icon-content"><i class="fas fa-play"></i></span>
                                            </a>

                                        </div>
                                        <h4 class="entity-title">
                                            <a class="content-link" href="<?= BASE_URL . '?act=detailMovies&movie_id=' . $movie['movie_id'] ?>"><?= $movie['title'] ?></a>
                                        </h4>
                                        <div class="entity-category">
                                            <a class="content-link" href="movies-blocks.html"><?= $movie['director'] ?></a>
                                        </div>
                                        <div class="entity-info">
                                            <div class="info-lines">
                                                <div class="info info-short">
                                                    <span class="text-theme info-icon"><i class="fas fa-star"></i></span>

                                                    <span class="info-text">6,8</span>
                                                    <span class="info-rest">/10</span>
                                                </div>
                                                <div class="info info-short">
                                                    <span class="text-theme info-icon"><i class="fas fa-clock"></i></span>
                                                    <span class="info-text"><?= $movie['duration'] ?></span>
                                                    <span class="info-rest">&nbsp;Giờ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="slick-arrows">
                        <div class="slick-arrow-prev">
                            <span class="th-dots th-arrow-left th-dots-animated">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </div>
                        <div class="slick-arrow-next">
                            <span class="th-dots th-arrow-right th-dots-animated">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Danh sách phim đang chiếu  -->

    <!-- lấy ngày phim chiếu -->
    <?php
    $dayNow = date("d");
    $monthNow = date("F");
    $yearNow = date("y");
    // echo "Dates: $dayNow - $monthNow $yearNow";
    ?>


    <section class="section-long">
        <div class="container">
            <div class="section-head">
                <h2 class="section-title text-uppercase">Phim Đang Chiếu</h2>
                <p class="section-text">Dates: <?= $dayNow . " - " . $monthNow . " " . $yearNow ?></p>
            </div>
            <?php foreach ($movieShowings as $key => $movieShowing) { ?>
                <article class="movie-line-entity">
                    <div class="entity-poster" data-role="hover-wrap">
                        <div class="embed-responsive embed-responsive-poster">
                            <img class="embed-responsive-item" src="<?= $movieShowing['poster_url'] ?>" alt="" />
                        </div>
                    </div>
                    <div class="entity-content">
                        <h4 class="entity-title">
                            <a class="content-link" href="movie-info-sidebar-right.html"><?= $movieShowing['title'] ?></a>
                        </h4>
                        <div class="entity-category">
                            <a class="content-link" href="movies-blocks.html"><?= $movieShowing['director'] ?></a>
                        </div>
                        <div class="entity-info">
                            <div class="info-lines">
                                <div class="info info-short">
                                    <span class="text-theme info-icon"><i class="fas fa-star"></i></span>
                                    <span class="info-text">8,1</span>
                                    <span class="info-rest">/10</span>
                                </div>
                                <div class="info info-short">
                                    <span class="text-theme info-icon"><i class="fas fa-clock"></i></span>
                                    <span class="info-text"><?= $movieShowing['duration'] ?></span>
                                    <span class="info-rest">&nbsp;Giờ</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-short entity-text"><?= $movieShowing['description'] ?></p>
                    </div>
                    <div class="entity-extra">
                        <div class="text-uppercase entity-extra-title">Showtime</div>
                        <div class="entity-showtime">
                            <div class="showtime-wrap">
                                <?php
                                $showTimes = explode(',', $movieShowing['show_time']); // Tách chuỗi thành mảng
                                foreach ($showTimes as $key => $showTime) {
                                ?>
                                    <div class="showtime-item">
                                        <span class="btn-time btn text-center"><?= $showTime ?></span>
                                    </div>
                                <?php  } ?>
                            </div>
                        </div>
                    </div>
                </article>
            <?php  } ?>
        </div>
    </section>

    <!-- Phim Sắp Ra Mắt -->

    <section class="section-solid-long section-text-white position-relative">
        <div class="d-background" data-image-src="http://via.placeholder.com/1920x1080" data-parallax="scroll"></div>
        <div class="d-background bg-gradient-black"></div>
        <div class="container position-relative">
            <div class="section-head">
                <h2 class="section-title text-uppercase">Sắp Ra Mắt</h2>
            </div>
            <div class="slick-spaced slick-carousel" data-slick-view="navigation single">
                <div class="slick-slides">
                    <?php foreach ($CommingSoons as $key => $CommingSoon) { ?>
                        <div class="slick-slide">
                            <article class="movie-line-entity">
                                <div class="entity-preview">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <img class="embed-responsive-item" src="<?= $CommingSoon['poster_url'] ?>" alt="" />
                                    </div>
                                    <div class="d-over">
                                        <div class="entity-play">
                                            <a class="action-icon-theme action-icon-bordered rounded-circle" data-fancybox href="<?= $CommingSoon['trailer_url'] ?>" data-caption="Trailer of <?= $movie['title'] ?>">
                                                <span class="icon-content"><i class="fas fa-play"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="entity-content">
                                    <h4 class="entity-title">
                                        <a class="content-link" href="movie-info-sidebar-right.html"><?= $CommingSoon['title'] ?></a>
                                    </h4>
                                    <div class="entity-category">
                                        <a class="content-link" href="movies-blocks.html"><?= $CommingSoon['director'] ?></a>,
                                    </div>
                                    <div class="entity-info">
                                        <div class="info-lines">
                                            <div class="info info-short">
                                                <span class="text-theme info-icon"><i class="fas fa-calendar-alt"></i></span>
                                                <span class="info-text"><?= formartDate($CommingSoon['release_date']) ?></span>
                                            </div>
                                            <div class="info info-short">
                                                <span class="text-theme info-icon"><i class="fas fa-clock"></i></span>
                                                <span class="info-text"><?= $CommingSoon['duration'] ?></span>
                                                <span class="info-rest">&nbsp;Giờ</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-short entity-text"><?= $CommingSoon['description'] ?></p>
                                </div>
                            </article>
                        </div>
                    <?php } ?>
                </div>
                <div class="slick-arrows">
                    <div class="slick-arrow-prev">
                        <span class="th-dots th-arrow-left th-dots-animated">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </div>
                    <div class="slick-arrow-next">
                        <span class="th-dots th-arrow-right th-dots-animated">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact  -->

    <div class="gmap-with-map">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 ml-lg-auto">
                    <div class="gmap-form bg-white">
                        <h4 class="form-title text-uppercase">Liên Hệ
                            <span class="text-theme">Chúng Tôi</span>
                        </h4>
                        <p class="form-text">Cần hỗ trợ, hãy liên hệ với chúng tôi!!</p>
                        <form autocomplete="off">
                            <div class="row form-grid">
                                <div class="col-sm-6">
                                    <div class="input-view-flat input-group">
                                        <input class="form-control" name="name" type="text" placeholder="Name" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-view-flat input-group">
                                        <input class="form-control" name="email" type="email" placeholder="Email" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-view-flat input-group">
                                        <textarea class="form-control" name="message" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="px-5 btn btn-theme" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="map" style="height: 500px; width: 100%;"></div>
        </div>
    </section>
    <?php require_once './views/layout/footer.php' ?>
</body>

</html>