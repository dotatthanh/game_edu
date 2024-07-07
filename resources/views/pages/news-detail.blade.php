@extends('layouts.default')
@section('content')
    <div class="header5">
        <div class="tenmon">
            <h2>Chi tiết tin tức</h2>
        </div>
        <div class="gamezone">
            <div class="container">
                <div class="row">
                    <h2>{{ $data->title }}</h2>

                    <span class="date">
                        <i class="fas fa-clock"></i> {{ $data->created_at }}
                    </span>
                    {!! $data->summary !!}
                    {!! $data->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
