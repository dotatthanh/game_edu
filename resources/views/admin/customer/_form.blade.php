@csrf

<h4 class="card-title">Thông tin cơ bản</h4>
<p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="name">Họ và tên <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Họ và tên" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="username">Tên tài khoản <span class="text-danger">*</span></label>
            <input id="username" name="username" type="text" class="form-control" placeholder="Tên tài khoản" value="{{ old('username', $data_edit->username ?? '') }}">
            {!! $errors->first('username', '<span class="error">:message</span>') !!}
        </div>

    </div>

    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input id="email" name="email" type="text" class="form-control" placeholder="Email" value="{{ old('email', $data_edit->email ?? '') }}">
            {!! $errors->first('email', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="avatar">Ảnh đại diện</label>
            <input id="avatar" name="avatar" type="file" class="form-control">
            {!! $errors->first('avatar', '<span class="error">:message</span>') !!}
        </div>

    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu</button>
<a href="{{ route('customers.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
