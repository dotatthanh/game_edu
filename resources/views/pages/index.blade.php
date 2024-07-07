@extends('layouts.default')
@section('content')
    <div class="header5">
        <div class="tenmon">
            <h2>Game mới</h2>
        </div>
        <div class="gamezone">
            <div class="container">
                <div class="row">
                    @foreach ($games as $game)
                        <div class="col-3 mb-3 text-center">
                            <div class="game-card">
                                <a href="{{ $game->link }}">
                                    <img src="{{ asset($game->image) }}" alt="" class="w-100 ">
                                </a>

                                <h3 class="mt-2"><a href="{{ $game->link }}">{{ $game->name }}</a></h3>
                                <p>Thể loại: {{ $game->type->name }}</p>

                                @if (auth()->guard('web')->user() &&
                                        !auth()->guard('web')->user()->checkFavorite($game['id']))
                                    <form action="{{ route('web.game-like', $game->id) }}" method="post">
                                        @csrf
                                        <button>Yêu thích</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="header5">
        <div class="tenmon">
            <h2>Góc học tập</h2>
        </div>

        <div class="gamezone">
            <div class="container">
                <div class="row">
                    @if ($newsStudyFirst)
                    <div class="col-5 left">
                        <div class="headline top-news">
                            <img class="w-100"
                                src="{{ asset($newsStudyFirst->image) }}"
                                alt="{{ $newsStudyFirst->title }}">
                            <h3 class="title">
                                <a href="{{ route('web.news-detail', $newsStudyFirst->id) }}">{{ $newsStudyFirst->title }}</a>
                            </h3>
                            <span class="date">
                                <i class="fas fa-clock"></i> {{ $newsStudyFirst->created_at }}
                            </span>
                            {!! $newsStudyFirst->summary !!}
                        </div>
                    </div>
                    @endif
                    <div class="col-7 right">
                        @foreach ($newsStudy as $news)
                        {{ $news->id }}
                            <div class="headline news">
                                <h3 class="title">
                                    <a href="{{ route('web.news-detail', $news->id) }}">{{ $news->title }}</a>
                                </h3>
                                <span class="date">
                                    <i class="fas fa-clock"></i> {{ $news->created_at }}
                                </span>
                                {!! $news->summary !!}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
