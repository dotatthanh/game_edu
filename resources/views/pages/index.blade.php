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
                    <div class="col-4 mb-3 text-center">
                        <a href="{{ $game->link }}">
                            <img src="{{ asset($game->image) }}" alt="" class="w-100">
                        </a>

                        <h3 class="mt-2"><a href="{{ $game->link }}">{{ $game->name }}</a></h3>
                        <p>Thể loại: {{ $game->type->name }}</p>

                        @if (auth()->guard('web')->user() && ! auth()->guard('web')->user()->checkFavorite($game['id']))
                        <form action="{{ route('web.game-like', $game->id) }}" method="post">
                            @csrf
                            <button>Yêu thích</button>
                        </form>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
