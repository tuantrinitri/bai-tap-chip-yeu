<aside class="aside-featured">
   <div class="d-flex aside-title">

      <div class="flex-grow-1">
         <h4><span>{{ trans('web::common.feature') }}</span></h4>
      </div>
   </div>
   <div class="list-post">
      @foreach ($categories as $item)
      @foreach ($item->posts()->where('featured',1) as $k => $post)
      @if (isset($post->translate($lang, true)->title))
      <article class="item">
         <div class="image">
            <a href="{{ route('post.web.post', $post['slug']) }}" title="">
               <img src="{{ asset($post['image']) }}" alt="alt-image">
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
      @if ($k >= 5)
      @break
      @endif
      @endforeach
      @endforeach
   </div>
</aside>