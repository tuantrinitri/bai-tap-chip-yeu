<div class="row">
   <div class="col-md-4 col-lg-2 d-flex align-items-center">
      <h2 class="heading m-0">{{ trans('web::common.member_fip') }}</h2>
   </div>
   <div class="col-md-8 col-lg-10">
      <div class="slide-vertical">
         @foreach ($members as $member)
         <div class="slide-vertical__item">
            <a href="{{ $member['link'] }}" target="_blank" title="{{ $member['title'] }}">
               <img src="{{ asset($member['file_src']) }}" alt="{{ $member['title'] }}"  style="width: 1000px;height: 100px;object-fit: contain;">
            </a>
         </div>
         @endforeach
      </div>
   </div>
</div>