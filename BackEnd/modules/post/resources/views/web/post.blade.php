@extends('web::layouts.main_right')
@section('page_content')
<nav class="nav-breadcrumb pt-3">
   <ol class="breadcrumb">
      <li class="breadcrumb-item ">
         <a href="{{ route('index') }}">{{ trans('web::common.home') }}</a>
      </li>
      <li class="breadcrumb-item ">
         <a href="{{ route('post.web.category',$post->category->slug) }}">{{ $post->category->title }}</a>
      </li>
      <li class="breadcrumb-item active">
         <span>{{ Str::limit($post->title, 50)  }}</span>
      </li>
   </ol>
   <div class="bdtop1"></div>
   <div class="bdtop2"></div>
</nav>
<section class="single" id="detail">
   <header>
      <h1 class="title">{{ $post->title }}</h1>
      <h6 class="date"><i class="fa fa-clock"></i>{{ date('d-m-Y', strtotime($post['created_at']))  }}</h6>
   </header>
   <article>
      {!! $post->content !!}
      <h5 class="author text-right">
         {{ $post->author }}
      </h5>
   </article>
</section>
@endsection