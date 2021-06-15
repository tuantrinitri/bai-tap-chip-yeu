@extends('core::theme.layouts.default')
@section('page_content')
<div class="row ml-0 mr-0" style="border-bottom: 1px solid #ddd">
    <div class="col-md-5 p-0" style="border-right: 1px solid #ddd">
        <div class="card-body">
            <h6><strong>{{ trans('contact::admin.contact_info') }}</strong> <span class="float-right">{!!
                    mod_contact_get_html_status($contact['status']) !!}</span></h6>
            <div class="form-group row mb-0">
                <label class="col-form-label col-lg-3"><strong>{{ trans('contact::admin.title') }}</strong></label>
                <div class="col-lg-9 col-form-label">
                    {{ $contact['title'] }}
                </div>
            </div>
            <div class="form-group row mb-0">
                <label class="col-form-label col-lg-3"><strong>{{ trans('contact::admin.topic') }}</strong></label>
                <div class="col-lg-9 col-form-label">
                    {{ $contact['topic'] }}
                </div>
            </div>
            <div class="form-group row mb-0">
                <label class="col-form-label col-lg-3"><strong>{{ trans('contact::admin.sender_name') }}</strong></label>
                <div class="col-lg-9 col-form-label">
                    {{ $contact['sender_name'] }}
                </div>
            </div>
            <div class="form-group row mb-0">
                <label class="col-form-label col-lg-3"><strong>Email</strong></label>
                <div class="col-lg-9 col-form-label">
                    {{ $contact['sender_email'] }}
                </div>
            </div>
            <div class="form-group row mb-0">
                <label class="col-form-label col-lg-3"><strong>{{ trans('contact::admin.sender_at') }}</strong></label>
                <div class="col-lg-9 col-form-label">
                    {{ date('d/m/Y H:i:s', strtotime($contact['created_at'])) }}
                </div>
            </div>
            <div class="form-group row mb-0">
                <label class="col-form-label col-lg-12"><strong>{{ trans('contact::admin.content') }}</strong></label>
                <div class="col-lg-12 col-form-label">
                    <blockquote class="blockquote blockquote-bordered py-2 pl-2 mb-0">
                        {!! $contact['sender_content'] !!}
                    </blockquote>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7 p-0">
        <div class="card-body">
            <h6 class="mb-3">
                <strong>{{ trans('contact::admin.handding_info') }}</strong>
                @if ($contact['status'] < 3) <a href="javascript:;" data-toggle="modal" data-target="#modalCancelContact" class="btn btn-danger btn-sm float-right">
                    {{ trans('contact::admin.cancel_contact') }}</a>
                    @endif
            </h6>
            @if ($contact['status'] < 3) <form action="{{ route('contact.admin.edit',$contact['id']) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="type" value="reply">
                <div class="form-group row">
                    <label class="col-form-label col-lg-12"><strong>{{ trans('contact::admin.feedback_content') }}</strong></label>
                    <div class="col-lg-12">
                        <textarea id="content" name="reply_content" rows="3" class="form-control">{{ old('reply_content') }}</textarea>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-sm">{{ trans('contact::admin.send_feedback') }}</button>
                </div>
                </form>
                @else
                <div class="form-group row mb-0">
                    <label class="col-form-label col-lg-3"><strong>{{ trans('contact::admin.staff') }}</strong></label>
                    <div class="col-lg-9 col-form-label">
                        {{ user_display_name($contact['reply_by']) }}
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <label class="col-form-label col-lg-3"><strong>{{ trans('contact::admin.handding_at') }}</strong></label>
                    <div class="col-lg-9 col-form-label">
                        {{ date('d/m/Y H:i:s', strtotime($contact['reply_at'])) }}
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <label class="col-form-label col-lg-12"><strong>{{ trans('contact::admin.content') }}</strong></label>
                    <div class="col-lg-12 col-form-label">
                        <blockquote class="blockquote blockquote-bordered py-2 pl-2 mb-0">
                            {!! $contact['reply_content'] !!}
                        </blockquote>

                    </div>
                </div>
                @endif
        </div>
    </div>
</div>
@if ($contact['status'] < 3) <div id="modalCancelContact" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('contact::admin.cancel_contact') }}</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('contact.admin.edit',$contact['id']) }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="type" value="cancel">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-12"><strong>{{ trans('contact::admin.reason_to_cancel_contact') }}</strong></label>
                        <div class="col-lg-12">
                            <textarea name="cancel_content" rows="4" class="form-control" placeholder="{{ trans('contact::admin.enter_reason') }}"></textarea>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-dark btn-sm float-left" data-dismiss="modal">{{ trans('contact::admin.cancel') }}</button>
                        <button type="submit" class="btn btn-danger btn-sm">{{ trans('contact::admin.cancel_contact') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    @endif

    @endsection
    @section('custom_js')
    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function(){
        CKEDITOR.replace('content',{
            language: 'vi',
            height: 300,
            toolbarGroups: [
                { name: "basicstyles", groups: ["basicstyles", "cleanup"] },
                {
                    name: "paragraph",
                    groups: ["list", "indent", "blocks", "align", "bidi"]
                },
                { name: "justify" },
                { name: "links" },
                { name: "colors" },
                { name: "tools" },
                { name: "document", groups: ["mode", "document", "doctools"] }
            ]
        });
    });
    </script>
    @endsection
