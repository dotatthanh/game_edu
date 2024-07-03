@extends('welcome')
@section('content')
@include('components.banner', ['movies' => $popularMovies])
<main class="main-content">
    <section class="feature">
        <h2 class="feature-heading">Phổ biến</h2>
        <div class="carousel row swiper-container swiper">
            <!-- Swiper Wrapper -->
            <div class="swiper-wrapper">
                <!-- Các Swiper Slides -->
                @foreach($popularMovies as $movie)
                <div class="swiper-slide col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="movie-item">
                        <a href="{{ route('web.movie-detail', $movie['id']) }}" class="movie-link">
                            <img src="{{ $movie['poster'] }}" alt="" class="movie-item__img" loading="lazy" />
                            <div class="movie-info">
                                <h3 class="movie__heading">{{ $movie['title'] }}</h3>
                                <p class="movie__desc">{{ $movie['release_date'] }}</p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
                <!-- Nếu cần Navigation Buttons -->
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>

    <!-- Dành cho bạn -->
    <section class="feature mt-32">
        <h2 class="feature-heading">Sắp chiếu</h2>
        <div class="carousel row swiper-container swiper">
            <!-- Swiper Wrapper -->
            <div class="swiper-wrapper">
                <!-- Các Swiper Slides -->
                @foreach ($upcomingMovies as $movie)
                <div class="swiper-slide col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="movie-item">
                        <a href="{{ route('web.movie-detail', $movie['id']) }}" class="movie-link">
                            <img src="{{ $movie['poster'] }}" alt="" class="movie-item__img" loading="lazy" />
                            <div class="movie-info">
                                <h3 class="movie__heading">{{ $movie['title'] }}</h3>
                                <p class="movie__desc">{{ $movie['release_date'] }}</p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-button-prev btn-arrow btn-arrow-left"></div>
            <div class="swiper-button-next btn-arrow btn-arrow-right"></div>
        </div>
    </section>
</main>
@endsection
