<div class="banner">
    @foreach ($movies as $movie)
    <div class="banner-slide" style="background-image: url('{{ $movie['backdrop'] }}');"></div>
    <div class="banner_inner">
        <h1 class="primary-movie-name">{{ $movie['title'] }}</h1>
        <p class="primary-movie-info"> {{ $movie['release_date'] }}</p>
        <div class="primary-action">
            <a href="{{ route('web.movie-watch', $movie['id']) }}" class="primary-watch"><img src="./static/assets/button/watch-now.svg"
                    alt="Watch Now" /></a>
            @auth('web')
            <form action="{{ route('web.movie-like', $movie['id']) }}" method="POST">
                @csrf
                <button class="primary-save" id="likeButton" type="submit">
                    <img src="{{ asset('static/assets/button').(auth()->guard('web')->user()->checkFavorite($movie['id']) ? '/liked.svg' : '/like.svg') }}" class="likeImage" alt="Like" />
                </button>
            </form>
            @else
            <p class="likeImage">Đăng nhập để thích phim!</p>
            @endauth
        </div>
    </div>
    @endforeach
</div>
