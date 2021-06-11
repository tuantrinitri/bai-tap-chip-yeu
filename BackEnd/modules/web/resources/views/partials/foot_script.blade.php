<script src="{{ asset('assets/web/libs/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('assets/web/libs/rvslider/rvslider.min.js') }}"></script>
<script src="{{ asset('assets/web/libs/desoslide/jquery.desoslide.js') }}"></script>
<script src="{{ asset('assets/web/libs/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/web/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/web/libs/slick-master/slick/slick.js') }}"></script>
<script src="{{ asset('assets/web/libs/owl-carousel/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/web/libs/aos/aos.js') }}"></script>
<script src="{{ asset('assets/web/libs/fancy-box/fancy-box.js') }}"></script>
<script src="{{ asset('assets/web/js/javascript.js') }}"></script>


<script>
   $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

        return false;
    });


    $(() => {
        var createSlick = () => {
            let slider = $(".slider .multiple-items");

            slider.not('.slick-initialized').slick({
                autoplay: false,
                infinite: true,
                dots: true,
                arrow: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            adaptiveHeight: true,
                        },
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });
        }

        createSlick();

        $(window).on('resize orientationchange', createSlick);
    })


    $('.mutilmedia .slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.mutilmedia .slider-nav'
    });
    $('.mutilmedia .slider-nav').slick({
        slidesToShow: 12,
        slidesToScroll: 1,
        asNavFor: '.mutilmedia .slider-for',
        dots: false,
        focusOnSelect: true
    });

    $('.article-post__info  .article-feature .slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.article-post__info  .article-feature .slider-nav'
    });
    $('.article-post__info  .article-feature .slider-nav').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        asNavFor: '.article-post__info  .article-feature .slider-for',
        dots: true,
        arrows: true,
        focusOnSelect: true,
        responsive: [

            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            }
        ]
    });

    var btn = $('#to-top');

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, '300');
    });

    $('.back-link').click(function () {
        parent.history.back();
        return false;
    });

    function printData() {
        var divToPrintChiTiet = document.getElementById('detail');
        var divlink = window.location.href;
        var popupWin = window.open("", "", "width=700,height=800");
        popupWin.document.writeln(divToPrintChiTiet.innerHTML + '<br/> <b>Nguồn bài viết: ' + divlink + '</b>');
        popupWin.document.close();
        popupWin.focus();
        popupWin.print();

    }
    $("#printnew").on('click', function () {
        printData();
    });

    $('.toggle').click(function (e) {
        e.preventDefault();
        var $this = $(this);
        if ($('.toggle').find('.act').hasClass('collapsed')) {
            $('.toggle').find('.act').removeClass('collapsed');
            $('.toggle').find('.act').html('<i class="fas fa-angle-down"></i>Hiển thị câu trả lời');
        }
        if ($this.next().hasClass('show')) {
            $this.next().removeClass('show');
            $this.next().slideUp(350);
        } else {
            $this.parent().parent().find('li .inner').removeClass('show');
            $this.parent().parent().find('li .inner').slideUp(350);
            $this.next().toggleClass('show');
            $this.parent().find('.act').addClass('collapsed');
            $this.parent().find('.act.collapsed').html('<i class="fas fa-angle-up"></i>Ẩn câu trả lời');
            $this.next().slideToggle(350);
        }
    });
</script>
<script>
   $(document).ready(function () {
        $('.tabs a').click(function () {
            $('.panel').hide();
            $('.tabs a.active').removeClass('active');
            $(this).addClass('active');
            var panel = $(this).attr('href');
            $(panel).fadeIn(1000);
            return false
        });
        $('.tabs li:first a').click();
    }); 
</script>
<script>
   $(".rvs-container").rvslider();

    var link = "https://vnexpress.net/my-noi-lanh-su-quan-trung-quoc-la-trung-tam-tinh-bao-4134615.html";
    // var link = window.location.href;
    var myOtherUrl = encodeURIComponent(link);
    console.log(myOtherUrl);
    $(".list-share .share-facebook").html('<div class="fb-share-button" data-href="' + link + '" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' + myOtherUrl + '%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>');

    $(".list-share .share-zalo").html('<div class="zalo-share-button" data-href="' + link + '" data-oaid="579745863508352884" data-layout="1" data-color="blue" data-customize=false></div>');

    $(".list-social .list-share").hide();
    $(".list-social .share").click(function () {
        if ($('.list-social .list-share:visible').length) {
            $('.list-social .list-share').hide();
        }
        else {
            $('.list-social .list-share').show();
        }
    });
</script>