<div class="card-body">
    <h6 class="card-title mb-0"><strong>{{ trans('user::department.list_department') }}</strong></h6>
</div>
@if (isset($departments) && count($departments) > 0)
<div class="table-responsive">
    <table class="table table-bordered table-td-middle">
        <thead class="bg-light">
            <tr>
                <th class="text-center" style="width:75px">ID</th>
                <th class="text-center" style="width:40%">{{ trans('user::department.department_name') }}</th>
                <th class="text-center">{{ trans('core::table.column_description') }}</th>
                <th style="width:120px"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
            <tr>
                <td class="text-center">{{ $department['id'] }}</td>
                <td>
                    <strong>{{ $department['name'] }}</strong>
                </td>
                <td>{{ $department['description'] }}</td>
                <td class="text-center">
                    <a href="{{ route('department.admin.edit', $department['id']) }}" class="text-primary" data-popup="tooltip" title="{{ trans('core::button.edit') }}"><i class="fa fa-edit"></i></a>
                    <a href="javascript:;" onclick="askToDelete(this);return false;" data-href="{{ route('department.admin.delete', $department['id']) }}" data-popup="tooltip" title="{{ trans('core::button.delete') }}" class="text-danger ml-2"><i class="fa fa-trash-alt"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="alert alert-info ml-3 mr-3">
    {{ trans('core::table.no_data') }}
</div>
@endif
