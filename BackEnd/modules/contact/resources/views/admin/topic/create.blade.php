@extends('core::theme.layouts.default')
@section('page_content')
<form action="{{ route('contact.topic.admin.create') }}" method="POST">
    {{ csrf_field() }}
    <div class="row ml-0 mr-0">
        <div class="col-md-8 p-0" style="border-right: 1px solid #ddd">
            <div class="card-body">
                <div class="form-group">
                    <label>{{ trans('contact::admin.topic_name') }} <sup class="text-danger">(*)</sup></label>
                    <input name="name" type="text" class="form-control" placeholder="{{ trans('contact::admin.topic_name_pla') }}" value="{{ old('name') }}">
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3"><strong>{{ trans('contact::admin.status') }}</strong></label>
                    <div class="col-lg-9">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <div class="uniform-choice">
                                    <div class="uniform-choice">
                                        <input name="status" type="radio" class="form-check-input-styled" {{ old('status', 1) == 1 ? 'checked' : '' }} value="1">
                                    </div>
                                </div>
                                <span class="text-success">{{ trans('contact::admin.active') }}</span>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <div class="uniform-choice">
                                    <div class="uniform-choice">
                                        <input name="status" type="radio" class="form-check-input-styled" {{ old('status', 1) == 0 ? 'checked' : '' }} value="0">
                                    </div>
                                </div>
                                <span class="text-danger">{{ trans('contact::admin.deactive') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3"><strong>{{ trans('contact::admin.auto_send_mail') }}</strong></label>
                    <div class="col-lg-9">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <div class="uniform-choice">
                                    <div class="uniform-choice">
                                        <input name="mail_status" type="radio" class="form-check-input-styled" {{ old('mail_status', 1) == 1 ? 'checked' : '' }} value="1">
                                    </div>
                                </div>
                                <span class="text-success">{{ trans('contact::admin.active') }}</span>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <div class="uniform-choice">
                                    <div class="uniform-choice">
                                        <input name="mail_status" type="radio" class="form-check-input-styled" {{ old('mail_status', 1) == 0 ? 'checked' : '' }} value="0">
                                    </div>
                                </div>
                                <span class="text-danger">{{ trans('contact::admin.deactive') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{ trans('contact::admin.note') }}</label>
                    <textarea name="note" class="form-control" placeholder="{{ trans('contact::admin.note_pla') }}" rows="3">{{ old('note') }}</textarea>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-form-label col-lg-3"><strong>{{ trans('contact::admin.mail_title') }}</strong> <sup class="text-danger">(*)</sup></label>
                    <div class="col-lg-9">
                        <input name="mail_title" value="{{ old('mail_title') }}" type="text" class="form-control" placeholder="{{ trans('contact::admin.mail_title_pla') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-12"><strong>{{ trans('contact::admin.mail_content') }}</strong> <sup class="text-danger">(*)</sup></label>
                    <div class="col-lg-12">
                        <textarea id="content" name="mail_content" rows="3" class="form-control">{{ old('mail_content') }}</textarea>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ route('contact.topic.admin.list') }}" class="btn btn-dark">{{ trans('contact::admin.cancel') }}</a>
                    <button type="submit" class="btn btn-primary">{{ trans('contact::admin.create') }}</button>
                </div>
            </div>
        </div>
        <div class="col-md-4 p-0">
            <div class="card-body">
                <h6><strong>{{ trans('contact::admin.param_title') }}</strong></h6>
                <div class="alert alert-info alert-sm">
                    {{ trans('contact::admin.param_title_sub') }}
                </div>

                <div class="list-group list-group-bordered">
                    @foreach ($variables as $variable)
                    <a href="javascript:;" onclick="insert_var_to_content('{{ $variable['code'] }}')" class="list-group-item text-dark">
                        <strong>{{ trans($variable['title']) }}</strong>
                        <span class="ml-auto text-primary">{{ $variable['code'] }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('custom_js')
<script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    $(document).ready(function(){
        CKEDITOR.replace('content',{
            language: 'vi',
            height: 400,
            filebrowserBrowseUrl: '/file-manager/ckeditor'
        });
    });
    function insert_var_to_content(code) {
        CKEDITOR.instances.content.insertHtml(code);
    }
</script>
@endsection
