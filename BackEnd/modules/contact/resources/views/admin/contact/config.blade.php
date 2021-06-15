@extends('core::theme.layouts.default')
@section('page_content')
<div class="card-body">
    <form action="{{ route('contact.admin.config') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group row">
            <label class="col-form-label col-lg-12"><strong>{{ trans('contact::admin.title_config') }}</strong></label>
            <div class="col-lg-12">
                <textarea id="content" name="description" class="form-control">{{ old('description', setting('description', '', 'Contact')) }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-info">{{ trans('contact::admin.save') }}</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('custom_js')
<script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    $(document).ready(function(){
        CKEDITOR.replace('content',{
            language: 'vi',
            height: 400,
            filebrowserBrowseUrl: '/file-manager/ckeditor'
        })

    });
</script>
@endsection
