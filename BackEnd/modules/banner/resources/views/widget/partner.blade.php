<div class="row">
   <div class="col-md-4 col-lg-2 d-flex align-items-center">
      <h2 class="heading m-0">{{ trans('web::common.partner_fip') }}</h2>
   </div>
   <div class="col-md-8 col-lg-10">
      <div class="slide-vertical">
         @foreach ($partners as $partner)
         <div class="slide-vertical__item">
            <a href="{{ $partner['link'] }}" target="_blank" title="{{ $partner['title'] }}">
               <img src="{{ asset($partner['file_src']) }}" alt="connect-image"  style="width: 1000px;height: 100px;object-fit: contain;">
            </a>
         </div>
         @endforeach
      </div>
   </div>
</div>