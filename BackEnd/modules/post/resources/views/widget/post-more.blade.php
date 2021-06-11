<ul>
   @foreach ($posts as $k => $item)
   @if (isset($item->translate($lang, true)->title))
   <li>
      <a href="{{ route('post.web.post',$item['slug']) }}" title="{{ $item->title }}">{{ $item->title }}</a>
   </li>
   @endif
   @if ($k++ >= 9)
   @break
   @endif
   @endforeach
</ul>