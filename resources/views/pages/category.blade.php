@extends('welcome')
@section('content')
<main class="main-content" style="margin-top: 80px;">
    <section class="feature">
        <h2 class="feature-heading">{{ $categoryName }}</h2>
        <div class="carousel row swiper-container swiper">
            <!-- Swiper Wrapper -->
            <div class="swiper-wrapper">
                <!-- Các Swiper Slides -->
                @foreach($data as $movie)
                @if ($movie['poster_path'] != null)
                <div class="swiper-slide col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="movie-item">
                        <a href="{{ route('web.movie-detail', $movie['id']) }}" class="movie-link">
                            <img src="{{ env('TMDB_URL_IAMGE') . $movie['poster_path'] }}" alt="" class="movie-item__img" loading="lazy" />
                            <div class="movie-info">
                                <h3 class="movie__heading">{{ $movie['title'] }}</h3>
                                <p class="movie__desc">{{ $movie['release_date'] }}</p>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                @endforeach
                <!-- Nếu cần Navigation Buttons -->
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>
</main>
@endsection
