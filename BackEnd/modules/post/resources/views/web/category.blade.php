@extends('web::layouts.main_right')
@section('page_content')
<nav class="nav-breadcrumb pt-3">
   <ol class="breadcrumb">
      <li class="breadcrumb-item ">
         <a href="{{ route('index') }}">{{ trans('web::common.home') }}</a>
      </li>
      <li class="breadcrumb-item active">
         <span>{{ $category->title }}</span>
      </li>
   </ol>
   <div class="bdtop1"></div>
   <div class="bdtop2"></div>
</nav>
<section class="news-event-content">
   @foreach ($category->posts() as $post)
   @if (isset($post->translate($lang, true)->title))
   <article class="post-news-event">
      <div class="date">
         <h6>
            <span class="date">
               {{ date('d', strtotime($post['created_at'])) }}
            </span>
            <span class="month">
               {{ date('m', strtotime($post['created_at'])) }}
            </span>
         </h6>
      </div>

      <div class="post-news-event__image">
         <div class="box">
            <a href="{{ route('post.web.post',$post['slug']) }}" title="">
               <img src={{ asset($post['image']) }} alt="alt-image">
            </a>
         </div>
      </div>
      <div class="post-news-event__post">
         <h3 class="title">
            <a href="{{ route('post.web.post',$post['slug']) }}" rel="noopener noreferrer" title="">
               {{ $post->title }}
            </a>
         </h3>
         <p class="post-news-event__text mb-2">
            {{ Str::limit($post->description, 300)  }}
         </p>
         <a href="{{ route('post.web.post',$post['slug']) }}" class="view-more" title="">Xem thêm<span>[+]</span></a>
      </div>
   </article>
   @endif
   @endforeach
</section>
<nav class="pagination-wrap pt-3">
   {{ $category->posts()->links('vendor.pagination.bootstrap-4')}}
</nav>
@endsection