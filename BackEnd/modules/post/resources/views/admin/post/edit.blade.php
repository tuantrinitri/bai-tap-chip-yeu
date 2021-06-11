@extends('core::theme.layouts.default')
@section('page_content')
<div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
        <h4><i class="far fa-newspaper mr-2"></i> <span class="font-weight-semibold">{{ trans('post::post.name') }}</span> -
            {{ trans('post::post.list') }}</h4>
        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
    </div>
    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="{{route('post.admin.index')}}" class="btn btn-primary btn-sm">{{ trans('post::post.posts') }}</a>
        </div>
    </div>
</div>
<form action="{{ route('post.admin.edit', $post['id']) }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $post['id'] }}">
    <div class="row ml-0 mr-0">
        <div class="col-md-8 p-0" style="border-right: 1px solid #ddd">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>{{ trans('post::post.title') }}</strong> <sup class="text-danger">(*)</sup></label>
                    <div class="col-lg-9">
                        <input placeholder="{{ trans('post::post.title') }}" id="txtTitle" name="title" value="{{ old('title', $transtion['title']) }}" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>{{ trans('post::post.slug') }}</strong> <sup class="text-danger">(*)</sup></label>
                    <div class="col-lg-9">
                        <div class="input-group">
                            <input placeholder="{{ trans('post::post.slug') }}" id="txtSlug" type="text" class="form-control" name="slug" value="{{ old('slug', $post['slug']) }}">
                            <div class="input-group-prepend mr-0">
                                <a href="javascript:;" onclick="get_slug('#txtTitle', '#txtSlug');" class="btn btn-dark btn-sm"><em class="fa fa-sync"></em></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>{{ trans('post::post.image') }}</strong> <sup class="text-danger">(*)</sup></label>
                    <div class="col-lg-9">
                        <div class="input-group areaBrowserFile">
                            <input placeholder="{{ trans('post::post.image') }}" readonly type="text" id="post-image" class="form-control" name="image" value="{{ old('image', $post['image']) }}">
                            <div class="input-group-prepend mr-0">
                                <button class="btn btn-light btn-sm btn-remove-file text-danger" type="button"><i class="fa fa-times"></i></button>
                                <button class="btn btn-dark btn-sm btn-choose-file" data-id="post-image" type="button"><i class="fa fa-image mr-1"></i>{{ trans('post::post.image') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>{{ trans('post::post.description') }}</strong></label>
                    <div class="col-lg-9">
                        <textarea placeholder="{{ trans('post::post.description') }}" name="description" class="form-control" rows="5">{{ old('description', $transtion['description']) }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-12 col-form-label">
                        <strong>{{ trans('post::post.description') }}</strong> <sup class="text-danger">(*)</sup>
                    </label>
                    <div class="col-lg-12">
                        <textarea placeholder="{{ trans('post::post.description') }}" id="content" name="content">{{ old('content', $transtion['content']) }}</textarea>
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
                                        <input name="locale" type="radio" class="form-check-input-styled lang" {{ isset($transtion['locale']) && $transtion['locale'] != 'vi' ? 'disabled' : '' }} {{ isset($transtion['locale']) && $transtion['locale'] =='vi' ? 'checked' : '' }} value="vi">
                                    </div>
                                </div>
                                <img src="{{ asset('assets/admin/images/vn.svg') }}" alt="" width="20" height="20" srcset="">
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <div class="uniform-choice">
                                    <div class="uniform-choice">
                                        <input name="locale" type="radio" class="form-check-input-styled lang" {{ isset($transtion['locale']) && $transtion['locale'] =='en' ? 'checked' : '' }} {{ isset($transtion['locale']) && $transtion['locale'] != 'en' ? 'disabled' : '' }} value="en">
                                    </div>
                                </div>
                                <span class="text-danger"><img src="{{ asset('assets/admin/images/en.svg') }}" alt="" width="20" height="20" srcset=""></span>
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-lg-12 col-form-label"><strong>{{ trans('post::category.name') }}</strong> <sup class="text-danger">(*)</sup></label>
                    <div class="col-lg-12">
                        <input type="hidden" name="old_category" value="{{ $transtion['category_id'] }}" id="category">
                        <select name="category_id" class="form-control select-category" id="category-show">
                            <option value="">--{{ trans('post::post.selected') }} --</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label><strong>Tags</strong></label>
                    <input name="tags" type="text" class="form-control" placeholder="Tags" value="{{ old('tags', $post['tags']) }}">
                </div>
                <div class="form-group">
                    <label><strong>{{ trans('post::post.author') }}</strong></label>
                    <input name="author" type="text" class="form-control" placeholder="{{ trans('post::post.author') }}" value="{{ old('author', $post['author']) }}">
                </div>
                <div class="form-group">
                    <label><strong>{{ trans('post::post.source') }}</strong></label>
                    <input name="source" type="text" class="form-control" placeholder="{{ trans('post::post.source') }}" value="{{ old('source', $post['source']) }}">
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label"><strong>{{ trans('post::post.featured') }}</strong> </label>
                    <div class="col-md-9">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input name="featured" type="checkbox" class="form-check-input-styled" value="1" {{ old('featured', $post['featured']) ? 'checked' : '' }}>
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
                                        <input name="status" type="radio" class="form-check-input-styled" {{ old('status', $post['status']) == 1 ? 'checked' : '' }} value="1">
                                    </div>
                                </div>
                                <span class="text-success">{{ trans('post::post.activate') }}</span>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <div class="uniform-choice">
                                    <div class="uniform-choice">
                                        <input name="status" type="radio" class="form-check-input-styled" {{ old('status', $post['status']) == 0 ? 'checked' : '' }} value="0">
                                    </div>
                                </div>
                                <span class="text-danger">{{ trans('post::post.deactivate') }}</span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="text-center mb-5">
        <a href="{{ route('post.admin.index') }}" class="btn btn-dark">{{ trans('post::post.cancel') }}</a>
        <button type="submit" class="btn btn-primary">{{ trans('post::post.edit') }}</button>
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
<script>
    $(document).ready(function() {
    var lang = $('input[name="locale"]:checked').val();
    if (lang) {
        $.ajax({
            type: 'post',
            url: "{{ route('post.ajax.langue') }}",
            data: {
                _token: _token,
                lang: lang
            },
            dataType: 'JSON',
            success: function(data) {
                $.each(data['data'], function(i, item) {
                    var result = "<option value='" + item.category_id + "'>" + item.title + "</option>";
                    $('#category-show').append(result);
                });
                    function selectCategory() {
                        var old = parseInt($('#category').val());
                        var test = $('#category-show').val();
                        var listOptions = document.getElementById("category-show")
                        for (var i = 0; i < listOptions.length; i++) {
                            let valueOption = listOptions[i].getAttribute("value")
                            if (valueOption == old) {
                                listOptions[i].setAttribute('selected','selected')
                            }
                        }
                    }
                    selectCategory();
            }
        });
    }
});
</script>
@endsection