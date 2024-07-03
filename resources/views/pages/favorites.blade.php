@extends('layouts.default')
@section('content')
    <div class="header5">
        <div class="tenmon">
            <h2>Game yêu thích</h2>
        </div>
        <div class="gamezone">
            <div class="container">
                <div class="row">
                    @foreach ($data as $favorite)
                    <div class="col-4 mb-3 text-center">
                        <a href="{{ $favorite->game->link }}">
                            <img src="{{ asset($favorite->game->image) }}" alt="" class="w-100">
                        </a>

                        <h3 class="mt-2"><a href="{{ $favorite->game->link }}">{{ $favorite->game->name }}</a></h3>
                        <p>Thể loại: {{ $favorite->game->type->name }}</p>

                        <form action="{{ route('web.game-like', $favorite->game->id) }}" method="post">
                            @csrf
                            <button>Bỏ yêu thích</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
