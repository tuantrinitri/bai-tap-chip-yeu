<ul class="list-item">
   @foreach ($categories as $item)
   <li>
      <a href="{{ route('post.web.category', $item['slug']) }}" title="{{ $item->title }}">{{ $item->title }}</a>
   </li>
   @endforeach

</ul>