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
    <section class="section-long">
        <div class="container">
            <div class="section-pannel">
                <div class="grid row">
                    <div class="col-md-10">
                        <form action="<?= BASE_URL . '?act=movieOfgenre&genre_id=' . $GenreOfId['genre_id'] ?>">
                            <div class="row form-grid">
                                <div class="col-sm-6 col-lg-4">
                                    <div class="input-view-flat input-group">
                                        <select class="form-control" name="genre">
                                            <option selected="true"><?= $GenreOfId['name'] ?></option>
                                            <?php foreach ($genres as $key => $value) { ?>
                                                <option><?= $value['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php foreach ($movieOfGenres as $movieOfGenre) { ?>
                <article class="movie-line-entity">
                    <div class="entity-poster" data-role="hover-wrap">
                        <div class="embed-responsive embed-responsive-poster">
                            <img class="embed-responsive-item" src="<?= $movieOfGenre['poster_url'] ?>" alt="" />
                        </div>
                    </div>
                    <div class="entity-content">
                        <h4 class="entity-title">
                            <a class="content-link" href="<?= BASE_URL . '?act=detailMovies&movie_id=' . $movieOfGenre['movie_id'] ?>"><?= $movieOfGenre['title'] ?></a>
                        </h4>
                        <div class="entity-category">
                            <a class="content-link" href="movies-blocks.html"><?= $movieOfGenre['director'] ?></a>
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
                                    <span class="info-text"><?= $movieOfGenre['duration'] ?></span>
                                    <span class="info-rest">&nbsp;Giờ</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-short entity-text"><?= $movieOfGenre['description'] ?></p>
                    </div>
                    <div class="entity-extra">
                        <div class="text-uppercase entity-extra-title">Showtime</div>
                        <div class="entity-showtime">
                            <div class="showtime-wrap">
                                <?php
                                $showTimes = explode(',', $movieOfGenre['show_time']); // Tách chuỗi thành mảng
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
            <?php } ?>


        </div>
    </section>

    <?php require_once './views/layout/footer.php' ?>
</body>

</html>