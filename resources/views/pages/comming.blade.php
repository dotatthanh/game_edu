@extends('welcome')
@section('content')

<main class="main-content mt-header">
    <section class="feature">
        <h2 class="feature-heading">Sắp chiếu</h2>
        <div class="carousel row">
            <div class="col-lg-1">
                <div class="movie-item">
                    <img src="./static/assets/imgs/movie-1.jpg" alt="Movie 1" />
                    <div class="movie-info">
                        <h3 class="movie__heading">Movie Name</h3>
                        <p class="movie__desc">Time</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-1">
                <div class="movie-item">
                    <img src="./static/assets/imgs/movie-2.jpg" alt="Movie 2" />
                    <div class="movie-info">
                        <h3 class="movie__heading">Movie Name</h3>
                        <p class="movie__desc">Time</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-1">
                <div class="movie-item">
                    <img src="./static/assets/imgs/movie-3.jpg" alt="Movie 3" />
                    <div class="movie-info">
                        <h3 class="movie__heading">Movie Name</h3>
                        <p class="movie__desc">Time</p>
                    </div>
                </div>
            </div>
    </section>
</main>
@endsection