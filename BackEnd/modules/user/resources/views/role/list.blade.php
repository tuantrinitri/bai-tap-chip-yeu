@extends('core::theme.layouts.default')
@section('page_content')
<div class="p-2">
    <a href="{{ route('role.admin.add') }}" class="btn btn-success btn-xs">{{ trans('user::role.create_role') }}</a>
</div>
@if (isset($roles) && count($roles) > 0)
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr class="bg-light">
                <th class="text-center" style="width:100px">{{ trans('core::table.column_order') }}</th>
                <th class="text-center">{{ trans('core::table.column_name') }}</th>
                <th class="text-center">{{ trans('core::table.column_title') }}</th>
                <th style="width:35%">{{ trans('core::table.column_description') }}</th>
                <th style="width:150px">{{ trans('core::table.column_action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td class="text-center">
                    <select data-min="{{ $minOrder }}" data-max="{{ $maxOrder }}" data-order="{{ $role['order'] }}" data-id="{{ $role['id'] }}" class="form-control changOrder"></select>
                </td>
                <td class="text-center">{{ $role['name'] }}</td>
                <td class="text-center">{{ $role['title'] ? $role['title'] : '-' }}</td>
                <td>{{ $role['description'] ? $role['description'] : '-' }}</td>
                <td class="text-center">
                    @if ($role['name'] != 'superadmin')
                    <a href="{{ route('role.admin.edit', $role['id']) }}" class="text-info" data-popup="tooltip" title="{{ trans('core::table.action_edit') }}"><i class="fa fa-edit"></i></a>
                    @if (!Arr::has(config('cms.system_roles'), $role['name']))
                    <a href="javascript:;" onclick="askToDelete(this);return false;" data-href="{{ route('role.admin.delete', $role['id']) }}" class="text-danger ml-2" data-popup="tooltip" title="{{ trans('core::table.action_delete') }}"><i class="fa fa-trash"></i></a>
                    @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="p-3">
    <div class="alert alert-info">{{ trans('core::table.no_data') }}</div>
</div>
@endif
@endsection

@section('custom_js')
<script>
    $(document).ready(function(){
        $(document).find('.changOrder').each(function() {
            var min = $(this).data('min');
            var max = $(this).data('max');
            var selected = $(this).data('order');
            var html = '';
            for (var i = min; i <= max; i++) {
                html += '<option value="' + i + '" ' + (i == selected ? 'selected' : '') + '>' + i + '</option>';
            }
            $(this).attr('onchange', 'change_order(this);return false;');
            $(this).html(html);
        });
    });

    function change_order(el)
    {
        var id = $(el).data('id');
        var order = $(el).val();
        // call ajax to chang order
        $(document).find('.changOrder').attr('disabled', 'disabled');
        $.ajax({
            type: 'post',
            url: "{{ route('role.ajax.order') }}",
            data: {
                _token: _token,
                id: id,
                order: order
            },
            dataType: 'JSON',
            success: function(data) {
                window.location.reload();
            }
        });
    }
</script>
@endsection
