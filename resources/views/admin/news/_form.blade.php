@csrf

<h4 class="card-title">Thông tin cơ bản</h4>
<p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

<div class="row mb-3">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="title">Tiêu đề <span class="text-danger">*</span></label>
            <input id="title" name="title" type="text" class="form-control" placeholder="Tiêu đề"
                value="{{ old('title', $data_edit->title ?? '') }}">
            {!! $errors->first('title', '<span class="error">:message</span>') !!}
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="form-group mb-3">
        <label for="class-id">Loại tin tức <span class="text-danger">*</span></label>
        <select class="form-control select2" name="type"  id="class-id">
            <option value="">Chọn loại tin tức</option>
            @foreach (getConst('news_type') as $id => $type)
                <option value="{{ $id }}"
                    {{ old('type', $data_edit->type ?? '') == $id ? 'selected' : '' }}>
                    {{ $type }}</option>
            @endforeach
        </select>
        {!! $errors->first('type', '<span class="error">:message</span>') !!}
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="image">Hình ảnh @if($routeType == 'create') <span class="error">*</span>@endif</label>
            <input id="image" name="image" type="file" class="form-control">
            {!! $errors->first('image', '<span class="error">:message</span>') !!}
        </div>
    </div>
</div>

<div class="mb-3">
    <label>Tóm tắt <span class="error">*</span></label>
    <textarea id="elm1" class="mb-2" name="summary">{{ isset($data_edit->summary) ? $data_edit->summary : '' }}</textarea>
    {!! $errors->first('summary', '<span class="error">:message</span>') !!}
</div>

<div class="mb-3">
    <label>Nội dung <span class="error">*</span></label>
    <textarea id="elm2" class="mb-2" name="content">{{ isset($data_edit->content) ? $data_edit->content : '' }}</textarea>
    {!! $errors->first('content', '<span class="error">:message</span>') !!}
</div>

<div class="mt-3">
    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu</button>
    <a href="{{ route('news.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
</div>
