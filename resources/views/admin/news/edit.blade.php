@extends('admin.layouts.master')

@section('title')
    Cập nhật tin tức
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Tin tức
        @endslot
        @slot('title')
            Cập nhật tin tức
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Cập nhật tin tức</h4>

                    <form method="POST" action="{{ route('news.update', $data_edit->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.news._form', ['routeType' => 'update'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

@section('script')
    <!--tinymce js-->
    <script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>
    <!-- select 2 plugin -->
    <script src="{{ asset('assets\libs\select2\select2.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('assets\js\pages\ecommerce-select2.init.js') }}"></script>
    <!-- form advanced init -->
    <script src="{{ asset('assets\js\pages\form-advanced.init.js') }}"></script>
    <script type="text/javascript">
        function getCategory() {
            var parentCategoryId = $(`select[name="parent_category_id"]`).val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            if (parentCategoryId) {
                // gọi api
                $.ajax({
                    url: "/admin/categories/get-sub-categories",
                    type: "POST",
                    data: {
                        parent_category_id: parentCategoryId,
                        _token: csrfToken,
                    },
                    success: function (respon) {
                        if (respon.data) {
                            $('select[name="category_id"]').empty();
                            if (respon.data.length > 0) {
                                $(`select[name="category_id"]`).prop('disabled', false);
                                $('select[name="category_id"]').append('<option value="">Select category</option>');
                                $.each(respon.data, function(index, item) {
                                    $('select[name="category_id"]').append('<option value="' + item.id + '">' + item.name + '</option>');
                                });
                            }
                            else {
                                $(`select[name="category_id"]`).prop('disabled', true);
                                $('select[name="category_id"]').append('<option value="">There are no categories</option>');
                            }
                            $(`select[name="sub_category_id"]`).prop('disabled', true);
                            $('select[name="category_id"]').select2();
                        }
                    },
                    errors: function () {
                        alert('Error server!!!');
                    }
                });
            }
            else {
                $(`select[name="category_id"]`).prop('disabled', true);
            }
        }

        function getSubCategory() {
            var categoryId = $(`select[name="category_id"]`).val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            if (categoryId) {
                // gọi api
                $.ajax({
                    url: "/admin/sub-categories/get-sub-categories",
                    type: "POST",
                    data: {
                        category_id: categoryId,
                        _token: csrfToken,
                    },
                    success: function (respon) {
                        if (respon.data) {
                            $('select[name="sub_category_id"]').empty();
                            if (respon.data.length > 0) {
                                $(`select[name="sub_category_id"]`).prop('disabled', false);
                                $('select[name="sub_category_id"]').append('<option value="">Select category</option>');
                                $.each(respon.data, function(index, item) {
                                    $('select[name="sub_category_id"]').append('<option value="' + item.id + '">' + item.name + '</option>');
                                });
                            }
                            else {
                                $(`select[name="sub_category_id"]`).prop('disabled', true);
                                $('select[name="sub_category_id"]').append('<option value="">There are no categories</option>');
                            }
                            $('select[name="sub_category_id"]').select2();
                        }
                    },
                    errors: function () {
                        alert('Error server!!!');
                    }
                });
            }
            else {
                $(`select[name="category_id"]`).prop('disabled', true);
            }
        }
    </script>
@endsection

@section('css')
    <!-- select2 css -->
    <link href="{{ asset('assets\libs\select2\select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection
