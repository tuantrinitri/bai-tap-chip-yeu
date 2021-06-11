@extends('Client::layouts.default')
@section('page_content')
<main id="main">
    <div id="content" role="main" class="content-area">
        <div class="container">
            <section id="my-account">
                <h3 class="title">Thay đổi mật khẩu</h3>
                <div class="box-change-password">
                    <form action="{{ route('client.post_change_password') }}" method="post">
                        @csrf
                        @include('Client::partials.errors')
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Mật khẩu cũ</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <button class="btn btn-default reveal" type="button" style="min-width: auto;padding: 0px !important;">
                                                <img src="{{ asset('assets/client/images/view.svg') }}" alt="view" class="view" style="width: 15px;">
                                                <img src="{{ asset('assets/client/images/weeping.svg') }}" alt="weeping" class="weeping" style="width: 15px;">
                                            </button>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control pwd" name="old_password" placeholder="Nhập mật khẩu cũ">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Mật khẩu mới</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <button class="btn btn-default reveal" type="button" style="min-width: auto;padding: 0px !important;">
                                                <img src="{{ asset('assets/client/images/view.svg') }}" alt="view" class="view" style="width: 15px;">
                                                <img src="{{ asset('assets/client/images/weeping.svg') }}" alt="weeping" class="weeping" style="width: 15px;">
                                            </button>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control pwd" name="password" placeholder="Nhập mật khẩu mới">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Nhập lại mật khẩu
                                mới</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <button class="btn btn-default reveal" type="button" style="min-width: auto;padding: 0px !important;">
                                                <img src="{{ asset('assets/client/images/view.svg') }}" alt="view" class="view" style="width: 15px;">
                                                <img src="{{ asset('assets/client/images/weeping.svg') }}" alt="weeping" class="weeping" style="width: 15px;">
                                            </button>
                                        </div>
                                    </div>
                                    <input type="password" class="form-control pwd" name="repassword" placeholder="Nhập lại mật khẩu mới">
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 text-center">
                            <button type="submit" class="btn btn-success" id="btn_save">Đổi mật khẩu</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</main>
@endsection
