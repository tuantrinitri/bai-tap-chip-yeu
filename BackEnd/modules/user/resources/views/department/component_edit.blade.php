<div class="card-body">
    <h6 class="card-title text-primary"><strong>SỬA PHÒNG BAN #{{ $current_department['id'] }}</strong></h6>
    <form action="{{ route('department.admin.edit', $current_department['id']) }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Tên phòng ban <sup class="text-danger">(*)</sup></label>
            <input name="name" type="text" class="form-control" placeholder="Nhập tên phòng ban" value="{{ old('name', $current_department['name']) }}">
        </div>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="description" class="form-control" placeholder="Nhập mô tả" rows="3">{{ old('description', $current_department['description']) }}</textarea>
        </div>
        <div class="text-right">
            <a href="{{ route('department.admin.list') }}" class="btn btn-default">{{ trans('core::button.cancel') }}</a>
            <button type="submit" class="btn btn-primary legitRipple">{{ trans('core::button.save') }}</button>
        </div>
    </form>
</div>