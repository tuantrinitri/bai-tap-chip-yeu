@extends('core::theme.layouts.default')
@section('page_content')
<div class="row ml-0 mr-0" style="border-bottom: 1px solid #ddd">
    <div class="col-md-4 p-0" style="border-right: 1px solid #ddd">
        @include('user::department.component_edit')
    </div>
    <div class="col-md-8 p-0">
        @include('user::department.component_list')
    </div>
</div>
@endsection
