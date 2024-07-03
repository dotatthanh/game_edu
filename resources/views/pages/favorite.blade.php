@extends('welcome')
@section('content')

<main class="main-content mt-header">
    <section class="feature">
        <h2 class="feature-heading">Thịnh hành</h2>
        <div class="carousel row swiper-container swiper">
            <!-- Swiper Wrapper -->
            <div class="swiper-wrapper">
                <!-- Các Swiper Slides -->
                <div class="swiper-slide col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="movie-item">
                        <a href="/path-to-movie-detail" class="movie-link">
                            <img src="./static/assets/imgs/movie-2.jpg" alt="Tên phim" class="movie-item__img"
                                loading="lazy" />
                            <div class="movie-info">
                                <h3 class="movie__heading">Movie Name</h3>
                                <p class="movie__desc">120 min</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="movie-item">
                        <a href="/path-to-movie-detail" class="movie-link">
                            <img src="./static/assets/imgs/movie-5.jpg" alt="Tên phim" class="movie-item__img"
                                loading="lazy" />
                            <div class="movie-info">
                                <h3 class="movie__heading">Movie Name</h3>
                                <p class="movie__desc">120 min</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="movie-item">
                        <a href="/path-to-movie-detail" class="movie-link">
                            <img src="./static/assets/imgs/movie-1.jpg" alt="Tên phim" class="movie-item__img"
                                loading="lazy" />
                            <div class="movie-info">
                                <h3 class="movie__heading">Movie Name</h3>
                                <p class="movie__desc">120 min</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="movie-item">
                        <a href="/path-to-movie-detail" class="movie-link">
                            <img src="./static/assets/imgs/movie-1.jpg" alt="Tên phim" class="movie-item__img"
                                loading="lazy" />
                            <div class="movie-info">
                                <h3 class="movie__heading">Movie Name</h3>
                                <p class="movie__desc">120 min</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="movie-item">
                        <a href="/path-to-movie-detail" class="movie-link">
                            <img src="./static/assets/imgs/movie-1.jpg" alt="Tên phim" class="movie-item__img"
                                loading="lazy" />
                            <div class="movie-info">
                                <h3 class="movie__heading">Movie Name</h3>
                                <p class="movie__desc">120 min</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="movie-item">
                        <a href="/path-to-movie-detail" class="movie-link">
                            <img src="./static/assets/imgs/movie-1.jpg" alt="Tên phim" class="movie-item__img"
                                loading="lazy" />
                            <div class="movie-info">
                                <h3 class="movie__heading">Movie Name</h3>
                                <p class="movie__desc">120 min</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="movie-item">
                        <a href="/path-to-movie-detail" class="movie-link">
                            <img src="./static/assets/imgs/movie-1.jpg" alt="Tên phim" class="movie-item__img"
                                loading="lazy" />
                            <div class="movie-info">
                                <h3 class="movie__heading">Movie Name</h3>
                                <p class="movie__desc">120 min</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>
</main>
@endsection