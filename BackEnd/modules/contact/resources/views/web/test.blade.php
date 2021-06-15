@extends('web::layouts.main')
@section('page_content')
<nav aria-label="breadcrumb" class="text-center">
    <div id="breadcrumb">
        <h1>Test send mail</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Trang chủ - Hồ sơ năng lực</a></li>
            <li class="breadcrumb-item active" aria-current="page">Test send mail</li>
        </ol>
    </div>
</nav>
<main id="main">
    <div id="content" role="main" class="content-area">
        <div class="container">
            <div class="form-ct">
                <div class="text-center">
                    <h3>LIÊN HỆ TRỰC TUYẾN</h3>
                </div>
                <form action="{{ route('post.contact.test_sendmail') }}" method="post">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                            <label for="services">Dịch vụ *</label>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                            <div class="form-group">
                                <select name="topic" class="form-control" id="services">
                                    @if($topics && count($topics))
                                    @foreach($topics as $topic)
                                    <option value="{{ $topic->name }}">{{ $topic->name }}
                                    </option>
                                    @endforeach
                                    @else
                                    <option value="Chưa có dịch vụ nào">Chưa có dịch vụ nào
                                    </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control " placeholder="Họ tên *" name="sender_name" id="sender_name" value="">
                            </div>
                            <div style="color: red">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email *" name="sender_email" id="sender_email" value="">
                            </div>
                            <div style="color: red">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Số điện thoại *" name="sender_phone" id="sender_phone" value="">
                            </div>
                            <div style="color: red">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Tiêu đề *" name="title" id="title" value="">
                            </div>
                            <div style="color: red">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <textarea class="form-control" rows="5" placeholder="Nội dung *" name="sender_content"></textarea>
                            </div>
                            <div style="color: red">
                            </div>
                        </div>
                    </div>
                    <div class="btnsend text-center">
                        <button class="btn btn-primary btn-sendd" type="submit">GỬI ĐI</button>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
