<div class="multiple-items">
   @foreach ($slide as $item)
   <div class="item">
      <img src="{{ asset($item['file_src']) }}" alt="alt-slide">
   </div>
   @endforeach
</div>