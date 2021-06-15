@extends('core::theme.layouts.default')
@section('custom_css')
<style>
    form .row {
        margin: auto;
        display: flex;
        justify-content: center;
    }

    table.table.datatable-basic {
        margin-bottom: 10px;
    }

    button.btn.btn-secondary.mr-1.btn-sm.legitRipple {
        margin-left: 20px;
    }

    .cms-paginate {
        margin-top: 0 !important;
    }

    tbody>tr>td {
        cursor: pointer;
    }

    .form-group {
        margin: 0 !important;
    }

</style>
@endsection
@section('page_content')
{{-- content --}}
@if (count($contacts) > 0)
<div class="p-2" style="display: flex;justify-content: flex-end;">
    <a href="javascript:;" class="btn btn-info btn-xs float-right" data-toggle="collapse" data-target="#filter-form"><i class="fas fa-filter"></i></a>
</div>
{{-- fitter --}}
<div class="card-body bg-light p-2 collapse show" id="filter-form" style="border-top: 1px solid rgb(221, 221, 221);">
    <form method="GET" action="{{ route('contact.admin.list') }}">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <input type="text" placeholder="{{ trans('contact::admin.pla_sender_name') }}" class="form-control" name="sender_name" aria-describedby="helpId" value="{{ isset($filterdata['sender_name']) ? $filterdata['sender_name'] : '' }}">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <input type="text" placeholder="{{ trans('contact::admin.pla_title') }}" class="form-control" name="title" aria-describedby="helpId" value="{{ isset($filterdata['title']) ? $filterdata['title'] : '' }}">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <input type="text" placeholder="{{ trans('contact::admin.pla_topic') }}" class="form-control" name="topic" aria-describedby="helpId" value="{{ isset($filterdata['topic']) ? $filterdata['topic'] : '' }}">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" name="status" id="">
                        <option value="-1">-- {{ trans('contact::admin.sel_status') }} --</option>
                        <option value="1" {{ (isset($filterdata['status']) ? $filterdata['status'] : -1) == 1 ? 'selected' : '' }}>
                            {{ trans('contact::admin.status_new') }}
                        </option>
                        <option value="2" {{ (isset($filterdata['status']) ? $filterdata['status'] : -1) == 2 ? 'selected' : '' }}>
                            {{ trans('contact::admin.status_received') }}</option>
                        <option value="3" {{ (isset($filterdata['status']) ? $filterdata['status'] : -1) == 3 ? 'selected' : '' }}>
                            {{ trans('contact::admin.status_reply') }}
                        </option>
                        <option value="4" {{ (isset($filterdata['status']) ? $filterdata['status'] : -1) == 4 ? 'selected' : '' }}>
                            {{ trans('contact::admin.status_cancel') }}</option>
                    </select>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" id="button-search-document"><i class="fas fa-filter mr-2"></i>{{ trans('contact::admin.filter') }}</button>
                <a href="{{ route('contact.admin.list') }}" class="btn btn-danger"><i class="fas fa-trash mr-2"></i>{{ trans('contact::admin.delete') }}</a>
            </div>
        </div>
    </form>
</div>
{{-- end fitter --}}
<form class="delete" action="{{ route('contact.admin.bulkaction') }}" method="post">
    {{ csrf_field() }}
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="bg-light">
                <tr>
                    <td colspan="7">
                        <div class="d-flex">
                            <div class="d-inline-flex align-items-center mr-auto">
                                {!! show_text_table_data($contacts) !!}
                            </div>
                            {{ $contacts->links() }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="text-center selectAll" style="width:50px;">
                        <input type="checkbox" class="form-check-input-styled all">
                    </th>
                    <th>{{ trans('contact::admin.sender_name') }}</th>
                    <th>{{ trans('contact::admin.title') }}</th>
                    <th class="text-center">{{ trans('contact::admin.topic') }}</th>
                    <th class="text-center">{{ trans('contact::admin.staff') }}</th>
                    <th class="text-center">{{ trans('contact::admin.status') }}</th>
                    <th class="text-center">{{ trans('contact::admin.create_at') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                <tr>
                    <td class="text-center"><input name="ids[]" type="checkbox" class="form-check-input-styled" value="{{ $contact['id'] }}"></td>
                    <td onclick="viewcontact('{{ route('contact.admin.view', $contact['id']) }}');">
                        {{ $contact['sender_name'] ? $contact['sender_name'] : '-' }}</td>
                    <td onclick="viewcontact('{{ route('contact.admin.view', $contact['id']) }}');">
                        {{ $contact['title'] ? $contact['title'] : '-' }}</td>
                    <td onclick="viewcontact('{{ route('contact.admin.view', $contact['id']) }}');" class="text-center">
                        {{ $contact['topic'] ? $contact['topic'] : '-' }}</td>
                    <td onclick="viewcontact('{{ route('contact.admin.view', $contact['id']) }}');" class="text-center">
                        {{ $contact['reply_by'] ? user_display_name($contact['reply_by']) : '-' }}
                    </td>
                    <td onclick="viewcontact('{{ route('contact.admin.view', $contact['id']) }}');" class="text-center">{!!
                        mod_contact_get_html_status($contact['status']) !!}</td>
                    <td onclick="viewcontact('{{ route('contact.admin.view', $contact['id']) }}');" class="text-center"><span data-popup="tooltip" title="{{ $contact['created_at'] }}">{{ cms_time_elapsed_string($contact['created_at']) }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">
                        @if (user_check_permission('contact.admin.bulkaction'))
                        <div class="input-group" style="width:250px;display: inline-flex;">
                            <select name="action" class="form-control form-control-sm d-inline">
                                <option value="delMulti">{{ trans('contact::admin.btn_del_item') }}</option>
                                <option value="delAll">{{ trans('contact::admin.btn_del_all') }}</option>
                            </select>
                            <div class="input-group-prepend mr-0">
                                <button type="submit" class="btn btn-sm btn-info">Thực hiện</button>
                            </div>
                        </div>
                        @endif
                        <div class="float-right">
                            {{ $contacts->links() }}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</form>
@else
<div class="alert alert-info m-2">
    {{ trans('contact::admin.no_data_yet') }}
</div>
@endif
{{-- end content --}}
@endsection
@section('custom_js')
<script>
    $('document').ready(function () {
        $('.uniform-checker').click(function (e) {
            if ($(this).find('input[type="checkbox"]').hasClass('all')) {
                $('input[type="checkbox"].form-check-input-styled:not(.all)').prop('checked', !$(this)
                    .find('span').first().hasClass('checked'));
            } else {
                if ($(this).find('span').first().hasClass('checked'))
                    $('.selectAll .uniform-checker .form-check-input-styled').prop('checked', false);
                else {
                    if ($('.uniform-checker span:not(.checked)').length == $('.uniform-checker')
                        .length - 1)
                        $('.selectAll .uniform-checker .form-check-input-styled').prop('checked', true);
                }
            }
            $.uniform.update();
        });
    });
</script>
<script>
    function viewcontact(link)
        {
            window.location.href = link;
        }
</script>
<script>
    $(".delete").on("submit", function(){
        return confirm("Dữ liệu không thể khôi phục. Bạn có thật sự muốn xóa?");
    });
</script>
@endsection
