@extends('layouts.default')
@section('content')
    <div class="header5">
        <div class="tenmon">
            <h2>Tin tức</h2>
        </div>
        <div class="gamezone">
            <div class="container">
                <div class="row">
                    @if ($posts->count() === 0)
                        Không có tin tức nào!
                    @else
                        @foreach ($posts as $post)
                        <div class="col-3 c-img mb-3">
                            <img src="{{ asset($post->image) }}" alt="">
                        </div>

                        <div class="col-9 mb-3">
                            <h4><a href="">{{ $post->title }}</a></h4>
                            <div>{{ $post->created_at }}</div>
                            <div>{!! $post->summary !!}</div>
                        </div>

                        {{ $posts->links() }}
                        @endforeach
                    @endif
                </div>
        </div>
        </div>
    </div>
@endsection
