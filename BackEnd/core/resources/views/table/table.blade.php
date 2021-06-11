@extends('core::theme.layouts.default')
@section('page_content')
{{ $dataTable->table() }}
@endsection
@section('custom_js')
{{ $dataTable->scripts() }}
@endsection
