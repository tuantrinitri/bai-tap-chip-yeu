@extends('mail.layout')

@section('mail_title', $mail_title)

@section('mail_content')
{!! $email !!}
@endsection
