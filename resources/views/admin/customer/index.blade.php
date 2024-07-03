@extends('admin.layouts.master')

@section('title')
    Danh sách người dùng
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Tài khoản
        @endslot
        @slot('title')
            Danh sách người dùng
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Danh sách người dùng</h4>

                    <form method="GET" action="{{ route('customers.index') }}" class="row mb-2">
                        <div class="col-sm-3">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" name="search" class="form-control" placeholder="Nhập họ và tên">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                            </button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 70px;" class="text-center">STT</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Tên tài khoản</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($stt = 1)
                                @foreach ($customers as $user)
                                    <tr>
                                        <td class="text-center">{{ $stt++ }}</td>
                                        <td>
                                            @if ($user->avatar)
                                                <div>
                                                    <img class="rounded-circle avatar-xs" src="{{ asset($user->avatar) }}" alt="">
                                                </div>
                                            @else
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle text-uppercase">
                                                        {{ substr($user->name, 0, 1) }}
                                                    </span>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td class="text-center">
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                <li class="list-inline-item px">
                                                    <a href="{{ route('customers.edit', $user->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                </li>

                                                <li class="list-inline-item px">
                                                    <form method="post" action="{{ route('customers.destroy', $user->id) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="Xóa" class="border-0 bg-white"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $customers->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
