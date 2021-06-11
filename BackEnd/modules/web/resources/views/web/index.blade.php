@extends('web::layouts.home')
@section('custom_css')
@endsection
@section('page_content')
<!-- slider  -->
<section class="slider">
   @widgetGroup('SLIDE_HOME')
</section>
<!-- link to  -->
<section class="connect-page">
   <div class="container">
      <div class="d-flex justify-content-around align-items-center">
         <div class="item">
            <a href="#" target="_blank" title="{{ trans('web::common.tunna') }}">
               <span class="icon">
                  <img src="{{ asset('assets/web/images/icon/tuna.webp') }}" alt="alt-image">
               </span>
               <span class="title">{{ trans('web::common.tunna') }}</span>
            </a>
         </div>
         <div class="item">
            <a href="http://vinatuna.org.vn/" target="_blank" title="{{ trans('web::common.company_tunna') }}">
               <span class="icon">
                  <img src="{{ asset('assets/web/images/cil_building.png') }}" alt="alt-image">
               </span>
               <span class="title">{{ trans('web::common.company_tunna') }}</span>
            </a>
         </div>
      </div>
   </div>
</section>
   <div class="connect-bottom">
         <!-- banner  -->
         <div class="container">
            @widgetGroup('TOP_BANNER')
         </div>
         {{-- end baner top --}}
      </div>
<section class="module pb-0" id="works" style="display: block; max-width: 100%;max-height: 100%;height: 530px;">
   <div class="container">
      <div class="row">
         <div class="text-center" style="padding-left: 35%">
            <h2 class="font-alt">{{ trans('web::common.activity') }}</h2>
            <div class="module-subtitle font-serif"></div>
         </div>
      </div>
   </div>
   @widgetGroup('ACTIVITY')
</section>
 <div class="connect-bottom">
        <div class="container">
            @widgetGroup('BOTTOM_BANNER')

        </div>
    </div>
<section class="section-news">
   <div class="container">
      <div class="row">
         <!-- list post  -->
         @widgetGroup('POST')
      </div>
      
   </div>
</section>

@if (app()->getLocale() == 'vi')
<section class="information">
   <div class="container">
      <div class="row" style="color: aliceblue; text-align: justify; ">
         <div class="col-md-6">
            <div class="heading-category mb-4">
               <h2 class="heading-2 heading-2--information">Mục tiêu của FIP</h2>
            </div>
            <div class="list-item">
               <div>Mục tiêu tổng quát của Dự án FIP cá ngừ là đạt được chứng nhận MSC vào năm 2022. Một số mục tiêu trung gian của FIP cũng được xác định để hỗ trợ cải thiện quản lý nghề cá bao gồm:
                  <ul>
                     <li> - Hỗ trợ xây dựng và thực thi các quy định về kiểm soát thu hoạch và các điểm tham chiếu giới hạn, hợp tác cùng dự án WPEA và WCPFC&nbsp; (Uỷ ban nghề cá Trung Tây Thái Bình Dương);</li>
                     <li>- Tiếp tục mở rộng, thử nghiệm và triển khai chương trình Quan sát viên trên tàu khai thác cá ngừ, bao gồm thí điểm sổ nhật ký điện tử (phối hợp trực tiếp với các doanh nghiệp tham gia FIP;</li>
                     <li>&nbsp;Hỗ trợ việc xây dựng Chương trình quan sát viên Quốc gia và đảm bảo nguồn tài chính bền vững để triển khai Chương trình hướng tới các mục tiêu của WCPFC;</li>
                     <li> - Xây dựng và áp dụng vào quản lý Chiến lược giảm thiểu các loài bị khai thác không chủ đích trong quản lý nghề cá bao gồm báo cáo đầy đủ về việc tương tác với rùa và cá mập;</li>
                     <li> - Thúc đẩy xã hội hoá và mở rộng việc sử dụng lưỡi câu vòng trong nghề khai thác cá ngừ (nghề câu tay) hướng tới đưa lưỡi câu vòng thành tiêu chuẩn trong nghề khai thác cá ngừ đại dương;</li>
                     <li> - Triển khai chương trình Truy xuất nguồn gốc, đã triển khai được ở một số nhà máy chế biến và đã thực hiện đánh giá bởi đơn vị đánh giá độc lập.&nbsp;</li>
                     <li> - Tiếp tục triển khai các hoạt động truyền thông nâng cao nhận thức cho ngư dân, doanh nghiệp chế biến và các bên có liên quan trong dự án FIP.</li>
                  </ul>
               </div>
            </div>
         </div>

         <div class="col-md-6">
            <div class="heading-category mb-4">
               <h2 class="heading-2 heading-2--information">THÀNH TỰU CỦA DỰ ÁN</h2>
            </div>
            <div class="list-post">
               <div>Những kết quả đáng được ghi nhận đến tháng 1 năm 2020:
                  <ul>
                     <li> - Hỗ trợ tiến trình Việt Nam gia nhập Tổ chức nghề cá Trung Tây Thái Bình Dương (WCPFC)</li>
                     <li> - Thúc đẩy sử dụng lưỡi câu vòng trong nghề khai thác trong đó thực hiện tốt Chiến lược giảm thiểu khai thác không chủ đích trong khi không làm giảm sản lượng loài khai thác mục tiêu (cá ngừ vây vàng).</li>
                     <li> - Tuyên truyền cho ngư dân và thực về bảo tồn rùa biển và cá mập.</li>
                     <li> - Hỗ trợ Bộ Nông nghiệp và Phát triển Nông thôn xây dựng Kế hoạch Quốc gia Quản lý nghề khai thác cá ngừ, cũng như hỗ trợ xây dựng các chính sách, quy định mới (sửa đổi/bổ sung các biện pháp kiểm soát thu hoạch, thí điểm hệ thống hạn ngạch khai thác, áp dụng quản lý rủi ro và bảo vệ các loài nguy cấp).</li>
                     <li> - Xây dựng và thí điểm sử dụng nhật ký điện tử trong nghề khai thác cá ngừ;</li>
                     <li> - Tiếp tục tập huấn và triển khai chương trình quan sát viên trên biển để hỗ trợ việc quản lý và phát triển Chiến lược giảm thiểu khai thác không chủ đích và hỗ trợ xây dựng Chương trình Quan sát viên Quốc gia.</li>
                     <li> - Thiết kế, xây dựng và thí điểm chương trình truy xuất nguồn gốc FIP với các doanh nghiệp trong nước để phân biệt sản phẩm cá ngừ từ tàu Việt Nam (sản phẩm FIP) với các sản phẩm khác trên thị trường xuất khẩu.</li>
                  </ul>
               </div>

            </div>
         </div>

      </div>
   </div>
</section>
@else
<section class="information">
   <div class="container">
      <div class="row" style="color: aliceblue; text-align: justify; ">
         <div class="col-md-6">
            <div class="heading-category mb-4">
               <h2 class="heading-2 heading-2--information">OBJECTIVES</h2>
            </div>
            <div class="list-item">
               <div>The overarching goal is to <u><strong>achieve MSC certification by 2022</strong></u>.&nbsp; Several intermediate objectives of the FIP have been identified, in contribution to the continual improvement in management of the fishery. These include:
                  <ul>
                     <li> - <strong>Supporting the development and implementation in management of harvest control rules</strong> and limit reference points, in partnership with WPEA project and wider WCPFC</li>
                     <li> - <strong>Continued expansion of training</strong>, piloting and at-sea deployment of onboard observers in the handline fishery, including piloting of electronic logbooks, in direct partnership with industry (FIP Participants)</li>
                     <li> - <strong>Supporting the establishment of a National Observer Program</strong> and securing the sustainable financing of its implementation towards WCPFC targets</li>
                     <li> - <strong>Development and application in management of a Bycatch Mitigation Strategy</strong>, including full reporting of sea turtle and shark encounters&nbsp;</li>
                     <li> - <strong>Continued socialization and expansion in the use of Circle Hooks</strong> in the handline fishery, mainstreaming their adoption across the sector</li>
                     <li> - <strong>Implementation of FIP traceability program</strong>, fully applied in all relevant processors and verified through independent 3rd party audits</li>
                     <li> - <strong>Ongoing communication</strong> and awareness programs with fishers, processors and other stakeholders related to the FIP</li>
                  </ul>
               </div>
            </div>
         </div>

         <div class="col-md-6">
            <div class="heading-category mb-4">
               <h2 class="heading-2 heading-2--information">ACHIEVEMENTS</h2>
            </div>
            <div class="list-post">
               <div>The following achievements have been recorded as of January 2020:
                  <ul>
                     <li> - <strong>Support the process of Viet Nam joining WCPFC</strong></li>
                     <li> - <strong>Expanding the use of circle hooks in the fishery</strong> which is a successful bycatch mitigation strategy that does not sacrifice target catch levels</li>
                     <li> - <strong>Communication on protection of sea turtles and sharks</strong></li>
                     <li> - <strong>Actively engaging with MARD in the development of a National Tuna Management Plan</strong> and other reformative policies and legal instruments (e.g. adoption of harvest control measures, piloting of quota systems, application of risk management and protection of at-risk species)</li>
                     <li> - <strong>Developing and piloting the use of e-logbooks</strong> in the handline tuna fleet</li>
                     <li> - <strong>Continuing to train and deploy at-sea fishery observers</strong> to inform the development of additional bycatch mitigation strategies and support the establishment of a National Observer Program</li>
                     <li> - <strong>Designing, developing, and piloting a first-of-its-kind FIP traceability program</strong> with domestic tuna processors to identify “FIP-eligible” yellowfin tuna products in the market</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endif
{{-- truc tiep do tu file --}}
<section class="mutilmedia" style="padding-top: 5px">
   <div class="container">
      <ul class="tabs">
         <li><a href="#gallery">{{ trans('web::common.image_gallery') }}</a></li>
         <li><a href="#video">{{ trans('web::common.video_gallery') }}</a></li>
      </ul>
      <div class="box-panel">

         <div id="gallery" class="panel">
            <div class="main">
               <div class="row">

                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                     <div class="slider slider-for">
                        @foreach ($images as $image)
                        <div class="item">
                           <a href="{{ asset('/upload/image-gallery/'.$image->getFilename()) }}" data-fancybox="images" data-caption="">
                              <img src="{{ asset('/upload/image-gallery/'.$image->getFilename()) }}" alt="gallery">
                           </a>
                        </div>
                        @endforeach
                     </div>
                  </div>

                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                     <div class="slider slider-nav">
                        @foreach ($images as $image)
                        <div class="item">
                           <img src="{{ asset('/upload/image-gallery/'.$image->getFilename()) }}" alt="gallery">
                        </div>
                        @endforeach
                     </div>
                  </div>

               </div>
            </div>
         </div>

         <div id="video" class="panel">
            <div class="rvs-container">
               @widgetGroup('VIDEO_GALLRY')
            </div>
         </div>
      </div>
</section>

@endsection