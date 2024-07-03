@extends('welcome')
@section('content')
<div class="movie mt-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img src="{{ env('TMDB_URL_IAMGE').($data['backdrop_path'] ? $data['backdrop_path'] : $data['poster_path']) }}" alt="" class="movie__main--img">
            </div>
            <div class="col-lg-6">
                <div class="movie__detail">
                    <div class="row-1">
                        <h2 class="movie__name">{{ $data['title'] }}</h2>
                        <div class="assess">
                            <img src="./static/assets/icons/star.svg" alt="">
                            <span>{{ $data['vote_average'] }}/10 </span>
                        </div>
                    </div>
                    <div class="row-2">
                        <span class="year">{{ $data['release_date'] }}</span>
                        <span class="genre">{{ $data['genres']? $data['genres'][0]['name'] : '' }}</span>
                        <span class="time">{{ $data['runtime'] }} phút</span>
                    </div>
                    <div class="row-3">
                        <p class="movie__desc">{{ $data['overview'] }}</p>
                    </div>
                    <div class="primary-action">
                        <a href="{{ route('web.movie-watch', $data['id']) }}" class="primary-watch"><img src="{{ asset('static/assets/button/watch-now.svg') }}" alt="" /></a>

                        @auth('web')
                        <form action="{{ route('web.movie-like', $data['id']) }}" method="POST">
                            @csrf
                            <button class="primary-save" id="likeButton" type="submit">
                                <img src="{{ asset('static/assets/button').(auth()->guard('web')->user()->checkFavorite($data['id']) ? '/liked.svg' : '/like.svg') }}" class="likeImage" alt="Like" />
                            </button>
                        </form>
                        @else
                        <p class="likeImage">Đăng nhập để thích phim!</p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
