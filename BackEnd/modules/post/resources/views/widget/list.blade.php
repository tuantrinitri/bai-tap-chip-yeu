@foreach ($categories as $k => $category)
<div class="col-xs-12 col-md-6 col-lg-4">
   <div class="d-flex h-title">
      <div class="flex-grow-1">
         <h2><span>{{ $category->title }}</span></h2>
      </div>
      <div class="align-self-center">
         <a class="read-more" href="{{ route('post.web.category',$category->slug) }}" title="">Xem thêm<span>[+]</span></a>
      </div>
   </div>
   <div class="list-post">
      @foreach ($category->posts() as $j=> $post)
      @if (isset($post->translate($lang, true)->title))
      <article class="item">
         <div class="image">
            <a href="{{ route('post.web.post', $post['slug']) }}" title="{{ $post->title }}">
               <img src="{{ asset($post['image']) }}" alt="{{ $post->title }}" style="width: 640px; height: 98px;">
            </a>
         </div>
         <div class="title">
            <h3>
               <a href="{{ route('post.web.post', $post['slug']) }}" title="{{ $post->title }}">
                  {{ $post->title }}
               </a>
            </h3>
         </div>
      </article>
      @endif
      @if ($j++ >= 4)
      @break
      @endif
      @endforeach
   </div>
</div>

@if ($k++ >= 2)
@break
@endif

@endforeach