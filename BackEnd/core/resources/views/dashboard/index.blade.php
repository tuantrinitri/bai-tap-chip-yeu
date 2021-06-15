@extends('core::theme.layouts.default')
@section('page_content')
<div class="row ml-2 mr-2 mt-3">
    <div class="col-lg-6">
        <div class="card bg-teal-400">
            <div class="card-body">
                <div class="d-flex">
                    <a href="{{ route('post.admin.index') }}">
                        <h3 class="font-weight-semibold mb-0" style="color: #fff;">Số lượng bài viết</h3>
                    </a>
                    <span class="badge bg-teal-800 badge-pill align-self-center ml-auto">{{ $numPost }}</span>
                </div>
                <div>
                    {{ $numPost }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card bg-pink-400">
            <div class="card-body">
                <div class="d-flex">
                    <a href="{{ route('post.admin.create') }}">
                        <h3 class="font-weight-semibold mb-0" style="color: #fff;">Thêm bài viết mới</h3>
                    </a>
                    <span class="badge bg-teal-800 badge-pill align-self-center ml-auto">{{ $numPost }}</span>
                </div>
                <div>
                    {{ $numPost }}
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="text-center">
    <h2>ĐĂNG TIN NHANH | QUICK POST</h2>
</div>
<hr>
<form action="{{ route('post.admin.create') }}" method="post">
    {{ csrf_field() }}
    <div class="row ml-0 mr-0">
        <div class="col-md-8 p-0" style="border-right: 1px solid #ddd">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>{{ trans('post::post.title') }}</strong> <sup class="text-danger">(*)</sup></label>
                    <div class="col-lg-9">
                        <input placeholder="{{ trans('post::post.title') }}" id="txtTitle" name="title" value="{{ old('title') }}" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>{{ trans('post::post.slug') }}</strong> <sup class="text-danger">(*)</sup></label>
                    <div class="col-lg-9">
                        <div class="input-group">
                            <input placeholder="{{ trans('post::post.slug') }}" id="txtSlug" type="text" class="form-control" name="slug" value="{{ isset($data['slug']) ? old('slug', $data['slug']) : old('slug') }}" {!! isset($data['slug']) ? 'readonly' : '' !!}>
                            <div class="input-group-prepend mr-0">
                                <a href="javascript:;" onclick="get_slug('#txtTitle', '#txtSlug');" class="btn btn-dark btn-sm" {!! isset($data['slug']) ? 'style=display:none;' : 'style=display:block;' !!}><em class="fa fa-sync"></em></a>
                                {!! isset($data['slug']) ? '' : '' !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>{{ trans('post::post.image') }}</strong> <sup class="text-danger">(*)</sup></label>
                    <div class="col-lg-9">
                        <div class="input-group areaBrowserFile">
                            <input placeholder="{{ trans('post::post.image') }}" readonly type="text" id="post-image" class="form-control" name="image" value="{{ old('image') }}">
                            <div class="input-group-prepend mr-0">
                                <button class="btn btn-light btn-sm btn-remove-file text-danger" type="button"><i class="fa fa-times"></i></button>
                                <button class="btn btn-dark btn-sm btn-choose-file" data-id="post-image" type="button"><i class="fa fa-image mr-1"></i>
                                    {{ trans('post::post.image') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>{{ trans('post::post.description') }}</strong></label>
                    <div class="col-lg-9">
                        <textarea placeholder="{{ trans('post::post.description') }}" name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-12 col-form-label">
                        <strong>{{ trans('post::post.content_post') }}</strong> <sup class="text-danger">(*)</sup>
                    </label>
                    <div class="col-lg-12">
                        <textarea id="content" name="content">{{ isset($data['content']) ? old('content', $data['content']) : old('content') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 p-0">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-form-label col-lg-3"><strong>{{ trans('post::category.locale') }}</strong> <sup class="text-danger">(*)</sup></label>
                    <div class="col-lg-9">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <div class="uniform-choice">
                                    <div class="uniform-choice" aria-disabled="">
                                        <input name="locale" type="radio" class="form-check-input-styled lang" {{ isset($data['lang']) && $data['lang'] != 'vi' ? 'disabled' : '' }} {{ isset($data['lang']) && $data['lang'] =='vi' ? 'checked' : '' }} value="vi">
                                    </div>
                                </div>
                                <img src="{{ asset('assets/admin/images/vn.svg') }}" alt="" width="20" height="20" srcset="">
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <div class="uniform-choice">
                                    <div class="uniform-choice">
                                        <input name="locale" type="radio" class="form-check-input-styled lang" {{ isset($data['lang']) && $data['lang'] =='en' ? 'checked' : '' }} {{ isset($data['lang']) && $data['lang'] != 'en' ? 'disabled' : '' }} value="en">
                                    </div>
                                </div>
                                <span class="text-danger"><img src="{{ asset('assets/admin/images/en.svg') }}" alt="" width="20" height="20" srcset=""></span>
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-lg-12 col-form-label"><strong>{{ trans('post::category.name') }}</strong>
                        <sup class="text-danger">(*)</sup></label>
                    <div class="col-lg-12">
                        <select name="category_id" class="form-control" id="category-show">
                            <option value="">--{{ trans('post::post.selected') }} --</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label><strong>Tags</strong></label>
                    <input name="tags" type="text" class="form-control" placeholder="tag" value="{{ old('tags') }}">
                </div>
                <div class="form-group">
                    <label><strong>{{ trans('post::post.author') }}</strong></label>
                    <input name="author" type="text" class="form-control" placeholder="{{ trans('post::post.author') }}" value="{{ old('author') }}">
                </div>
                <div class="form-group">
                    <label><strong>{{ trans('post::post.source') }}</strong></label>
                    <input name="source" type="text" class="form-control" placeholder="{{ trans('post::post.source') }}" value="{{ old('source') }}">
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label"><strong>{{ trans('post::post.featured') }}</strong> </label>
                    <div class="col-md-9">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input name="featured" type="checkbox" class="form-check-input-styled" value="1" {{ old('featured') ? 'checked' : '' }}>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label"><strong>{{ trans('post::post.status') }}</strong> </label>
                    <div class="col-md-9">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <div class="uniform-choice">
                                    <div class="uniform-choice">
                                        <input name="status" type="radio" class="form-check-input-styled" {{ old('status', 1) == 1 ? 'checked' : '' }} value="1">
                                    </div>
                                </div>
                                <span class="text-success">{{ trans('post::post.activate') }}</span>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <div class="uniform-choice">
                                    <div class="uniform-choice">
                                        <input name="status" type="radio" class="form-check-input-styled" {{ old('status', 1) == 0 ? 'checked' : '' }} value="0">
                                    </div>
                                </div>
                                <span class="text-danger">{{ trans('post::post.deactivate') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center mb-5">
                    <a href="{{ route('post.admin.index') }}" class="btn btn-dark">{{ trans('post::post.cancel') }}</a>
                    <button type="submit" class="btn btn-primary">{{ trans('post::post.save') }}</button>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection

@section('custom_js')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    $(document).ready(function(){
        CKEDITOR.replace('content',{
            language: 'vi',
            height: 800,
            filebrowserBrowseUrl: '/file-manager/ckeditor'
        });
    });
    function get_slug(elTitle, elSlug) {
    $.ajax({
        type: "post",
        url: "{{ route('get-slug') }}",
        data: {
            _token: _token,
            plainText: $(elTitle).val()
        },
        dataType: "JSON",
        success: function (data) {
            $(elSlug).val(data);
        }
    });
}
</script>
@endsection