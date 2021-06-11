@extends('core::theme.layouts.default')

@section('page_content')
<div style="height: calc(100vh - 140px);">
    <div id="fm"></div>
</div>
@endsection

@section('custom_css')
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endsection

@section('custom_js')
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
<script>
    $(document).ready(() => {
        $('body').addClass('sidebar-xs');
    });
</script>
@endsection
