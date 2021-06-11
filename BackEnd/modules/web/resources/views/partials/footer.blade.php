<footer id="footer" class="footer">
    <div class="footer__info">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-4 col-lg-6">
                    <div class="row ">
                        <div class="col-xs-12 col-md-12 col-lg-3">
                            <div class="heading">
                                <h2>Liên hệ</h2>
                            </div>
                            <div class="footer__logo text-center">
                                <img src="{{ logo_src(setting('site_logo')) ?? ''  }}" alt="logo">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-9">
                            <h3 class="title">{{ setting('site_name')  }}</h3>
                            <ul class="footer__contact-list">
                                <li class="footer__contact-it mb-1">Địa chỉ: {{ setting('site_address') }}</li>
                                <li class="footer__contact-it mb-1">Điện thoại: <a href="{{ setting('site_phone') }}" title="{{ setting('site_phone') }}">{{ setting('site_phone') }}</a> </li>
                                <li class="footer__contact-it mb-1">Fax: {{ setting('site_fax') }}</li>
                                <li class="footer__contact-it mb-1">Email: <a href="{{ setting('site_email') }}" title="{{ setting('site_email') }}">{{ setting('site_email') }}</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-xs-12 col-md-4 col-lg-3">
                    <div class="heading">
                        <h2>{{ trans('web::common.category') }}</h2>
                    </div>
                    @widgetGroup('FOOTER_LINK')
                </div>
                <div class="col-xs-12 col-md-4 col-lg-3">
                    <div class="heading">
                        <h2>{{ trans('web::common.link') }}</h2>
                    </div>
                    @widgetGroup('LINK')
                </div>
            </div>
        </div>
    </div>
    <div class="footer__copyright">
        <div class="container">
            <div class="footer__copyright-content">
                <p class="text-white  mb-0">Thiết kế bởi <a href="http://facebook.com/quoctuan.282" target="_blank" rel="noopener noreferrer">Trần Gia Group</a></p>
                {{-- <ul class="notification__content statisticl">
                    <li class="statisticl-item">
                        <div class="statisticl-item__info">
                            <span class="icon">
                                <img src="./assets/images/entypo_flash.png" alt="icon">
                            </span>
                            <p class="statisticl__text">Đang truy cập:</p>
                        </div>
                        <div class="statisticl-item__total">
                            <p class="statisticl__text ml-1">1</p>
                        </div>
                    </li>
                    <li class="statisticl-item">
                        <div class="statisticl-item__info">
                            <span class="icon mr-1">
                                <img src="./assets/images/bx_bx-bar-chart-alt-2.png" alt="icon">
                            </span>
                            <p class="statisticl__text">Tổng lượt truy cập:</p>
                        </div>
                        <div class="statisticl-item__total">
                            <p class="statisticl__text ml-1">425</p>
                        </div>
                    </li>
                </ul> --}}
            </div>
        </div>
    </div>
</footer>
<a id="to-top"><i class="fas fa-arrow-up"></i></a>