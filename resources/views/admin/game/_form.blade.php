@csrf

<h4 class="card-title">Thông tin cơ bản</h4>
<p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="name">Tên trò chơi <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Tên trò chơi" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="type-id">Thể loại <span class="text-danger">*</span></label>
            <select class="form-control select2" name="type_id"  id="type-id">
                <option value="">Chọn thể loại</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}"
                        {{ old('type_id', $data_edit->type_id ?? '') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('type_id', '<span class="error">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="image">Hình ảnh @if($routeType == 'create') <span class="text-danger">*</span> @endif</label>
            <input id="image" name="image" type="file" class="form-control">
            {!! $errors->first('image', '<span class="error">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="link">Link <span class="text-danger">*</span></label>
            <input id="link" name="link" type="text" class="form-control" placeholder="Link" value="{{ old('link', $data_edit->link ?? '') }}">
            {!! $errors->first('link', '<span class="error">:message</span>') !!}
        </div>

    </div>
</div>

<div class="mb-3">
    <label>Mô tả <span class="text-danger">*</span></label>
    <textarea id="elm1" class="mb-2" name="description">{{ isset($data_edit->description) ? $data_edit->description : '' }}</textarea>
    {!! $errors->first('description', '<span class="error">:message</span>') !!}
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('games.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
