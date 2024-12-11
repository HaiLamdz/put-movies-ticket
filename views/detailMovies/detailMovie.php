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
    <section class="after-head d-flex section-text-white position-relative">
        <div class="d-background" data-image-src="http://via.placeholder.com/1920x1080" data-parallax="scroll"></div>
        <div class="d-background bg-black-80"></div>
        <div class="top-block top-inner container">
            <div class="top-block-content">
                <h1 class="section-title">Movies info</h1>
                <div class="page-breadcrumbs" id="breadcrumbs">
                    <a class="content-link" href="index.html">Home</a>
                    <span class="text-theme mx-2"><i class="fas fa-chevron-right"></i></span>
                </div>
            </div>
        </div>
    </section>

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
                            <div class="entity-content">
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
                    <div class="section-line">
                        <div class="section-bottom">
                            <div class="row">
                                <div class="mr-auto col-auto">
                                    <div class="entity-links">
                                        <div class="entity-list-title">Share:</div>
                                        <a class="content-link entity-share-link" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="content-link entity-share-link" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="content-link entity-share-link" href="#"><i class="fab fa-google-plus-g"></i></a>
                                        <a class="content-link entity-share-link" href="#"><i class="fab fa-pinterest-p"></i></a>
                                        <a class="content-link entity-share-link" href="#"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section-line">
                        <div class="section-head">
                            <h2 class="section-title text-uppercase">Comments</h2>
                        </div>
                        <?php foreach ($listBinhLuans as $listBinhLuan) { ?>
                            <div class="comment-entity">
                                <div class="entity-inner">
                                    <div class="entity-content">
                                        <div class="d-flex">
                                            <div>
                                                <!-- <p  style="background-color: red;"></p> -->
                                                <img style="margin-right: 10px; max-width: 45px; max-height: 45px;" src="<?= $listBinhLuan['avata'] ?? 'https://cdn.sforum.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg' ?>" class="rounded-circle mt-1" alt="">
                                            </div>
                                            <div>
                                                <h4 class="entity-title"><?= $listBinhLuan['name'] ?></h4>
                                                <p class="entity-subtext"><?= $listBinhLuan['review_date'] ?></p>
                                                <p class="entity-text"><?= $listBinhLuan['comment'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="entity-extra">
                                        <div class="grid-md row">
                                            <div class="col-12 col-sm-auto">
                                                <div class="entity-rating">
                                                    <?php
                                                    $rating = $listBinhLuan['rating'];
                                                    for ($i = 1; $i <= 10; $i++) {
                                                        if ($i <= $rating) {
                                                    ?>
                                                            <span class="entity-rating-icon text-theme"><i class="fas fa-star"></i></span>
                                                        <?php } else { ?>
                                                            <span class="entity-rating-icon"><i class="fas fa-star"></i></span>
                                                    <?php }
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Bình Luận -->
                    <?php if (isset($_SESSION['user'])) { ?>

                        <div class="section-line">
                            <div class="section-head">
                                <h2 class="section-title text-uppercase">Bình Luận</h2>
                            </div>
                            <form action="<?= BASE_URL . '?act=insertComment' ?>" method="POST">
                                <div class="row form-grid">
                                    <input class="form-control" name="name" type="hidden" value="<?= $_SESSION['user']['id']  ?>" />
                                    <input class="form-control" name="movie" type="hidden" value="<?= $detailMovies['movie_id']  ?>" />
                                    <div class="col-12">
                                        <div class="input-view-flat input-group">
                                            <textarea class="form-control" name="content" placeholder="Bình luận dưới tên <?= $_SESSION['user']['name'] ?>"></textarea>
                                        </div>
                                    </div>
                                    <!-- Đánh giá theo sao -->
                                    <div class="col-12">
                                        <div class="rating-line">
                                            <label>Rating:</label>
                                            <div class="form-rating" name="rating">
                                                <input type="radio" id="rating-10" name="rating" value="10" />
                                                <label for="rating-10">
                                                    <span class="rating-active-icon"><i class="fas fa-star"></i></span>
                                                    <span class="rating-icon"><i class="far fa-star"></i></span>
                                                </label>
                                                <input type="radio" id="rating-9" name="rating" value="9" />
                                                <label for="rating-9">
                                                    <span class="rating-active-icon"><i class="fas fa-star"></i></span>
                                                    <span class="rating-icon"><i class="far fa-star"></i></span>
                                                </label>
                                                <input type="radio" id="rating-8" name="rating" value="8" />
                                                <label for="rating-8">
                                                    <span class="rating-active-icon"><i class="fas fa-star"></i></span>
                                                    <span class="rating-icon"><i class="far fa-star"></i></span>
                                                </label>
                                                <input type="radio" id="rating-7" name="rating" value="7" />
                                                <label for="rating-7">
                                                    <span class="rating-active-icon"><i class="fas fa-star"></i></span>
                                                    <span class="rating-icon"><i class="far fa-star"></i></span>
                                                </label>
                                                <input type="radio" id="rating-6" name="rating" value="6" />
                                                <label for="rating-6">
                                                    <span class="rating-active-icon"><i class="fas fa-star"></i></span>
                                                    <span class="rating-icon"><i class="far fa-star"></i></span>
                                                </label>
                                                <input type="radio" id="rating-5" name="rating" value="5" />
                                                <label for="rating-5">
                                                    <span class="rating-active-icon"><i class="fas fa-star"></i></span>
                                                    <span class="rating-icon"><i class="far fa-star"></i></span>
                                                </label>
                                                <input type="radio" id="rating-4" name="rating" value="4" />
                                                <label for="rating-4">
                                                    <span class="rating-active-icon"><i class="fas fa-star"></i></span>
                                                    <span class="rating-icon"><i class="far fa-star"></i></span>
                                                </label>
                                                <input type="radio" id="rating-3" name="rating" value="3" />
                                                <label for="rating-3">
                                                    <span class="rating-active-icon"><i class="fas fa-star"></i></span>
                                                    <span class="rating-icon"><i class="far fa-star"></i></span>
                                                </label>
                                                <input type="radio" id="rating-2" name="rating" value="2" />
                                                <label for="rating-2">
                                                    <span class="rating-active-icon"><i class="fas fa-star"></i></span>
                                                    <span class="rating-icon"><i class="far fa-star"></i></span>
                                                </label>
                                                <input type="radio" id="rating-1" name="rating" value="1" />
                                                <label for="rating-1">
                                                    <span class="rating-active-icon"><i class="fas fa-star"></i></span>
                                                    <span class="rating-icon"><i class="far fa-star"></i></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="px-5 btn btn-theme" type="submit">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </section>
            </div>
            <div class="sidebar section-long order-lg-last">
                <section class="section-sidebar">
                    <div class="section-head">
                        <h2 class="section-title text-uppercase">Phim Gần Đây</h2>
                    </div>
                    <?php foreach ($latestMovies as $key => $latestMovie) { ?>
                        <div class="movie-short-line-entity">
                            <a class="entity-preview" href="movie-info-sidebar-right.html">
                                <span class="embed-responsive embed-responsive-16by9">
                                    <img class="embed-responsive-item" style="width: 105px; height: auto;" src="<?= $latestMovie['poster_url'] ?>" alt="" />
                                </span>
                            </a>
                            <div class="entity-content">
                                <h4 class="entity-title">
                                    <a class="content-link" href="movie-info-sidebar-right.html"><?= $latestMovie['title'] ?></a>
                                </h4>
                                <p class="entity-subtext"><?= formartDate($latestMovie['release_date']) ?></p>
                            </div>
                        </div>
                    <?php  } ?>
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

</html>