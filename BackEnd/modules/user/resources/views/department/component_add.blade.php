<div class="card-body">
    <h6 class="card-title"><strong>{{ trans('user::department.add_department') }}</strong></h6>
    <form action="{{ route('department.admin.add') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label>{{ trans('user::department.department_name') }} <sup class="text-danger">(*)</sup></label>
            <input name="name" type="text" class="form-control" placeholder="{{ trans('user::department.department_name_placeholder') }}" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>{{ trans('core::form.label_description') }}</label>
            <textarea name="description" class="form-control" placeholder="{{ trans('core::form.placeholder_description') }}" rows="3">{{ old('description') }}</textarea>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary legitRipple">{{ trans('core::button.create') }}</button>
        </div>
    </form>
</div>