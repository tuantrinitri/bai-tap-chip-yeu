<style>
    .nav-link {
        display: flex;
        align-items: center;
        height: 100%;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <form class="form-inline my-2 my-lg-0 mobile">
            <input class="form-control mr-sm-2" type="text" placeholder="Tìm kiếm" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
        </form>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <img src="{{ asset('assets/web/images/menu-icon.png') }}" alt="icon">
        </button>
        <div class="collapse navbar-collapse" id="main-menu">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('index') }}"><i class="fa fa-home"></i></a>
                </li>
                @foreach ($parents as $parent)
                <li class="nav-item dropdown">
                    <a id="navbarDropdownMenuLink" href="{{ strstr($parent['link'], 'http://') || strstr($parent['link'], 'https://') ? $parent['link'] : URL::to($parent['link']) }}" {{ $parent->children()->count() > 0 ? 'data-toggle=dropdown aria-haspopup=true aria-expanded=false' : '' }} class="nav-link {{ $parent->children()->count() > 0 ? 'dropdown-toggle' : '' }} text-uppercase">{{ $parent['title'] }}</a>
                    @if ($parent->children()->count())
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach ($parent->children as $child)
                        <a class="dropdown-item" href="{{ strstr($child['link'], 'http://') || strstr($child['link'], 'https://') ? $child['link'] : URL::to($child['link']) }}"> {{ $child['target'] ? 'target=' . $child['target'] : '' }} {{ $child['title'] }}</a>
                        @endforeach
                    </div>
                    @endif
                </li>
                @endforeach
            </ul>
            {{-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Gõ từ khóa để tìm kiếm" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
            </form> --}}
        </div>
    </div>
</nav>
<script>
    $(document).ready(function(){
        var url = window.location.href;
        $('.navbar-menu').find('a[href="'+url+'"]').each((i,e)=>{
            if($(e).parent().hasClass('dropdown-menu')){
                $('.navbar-menu').find('.active').each((i,e)=>{
                    $(e).removeClass('active');
                });
                $(e).parent().parent().addClass("active");
                $(e).parent().find("a").css("background-color", "#e9ecef");
            } else {
                $('.navbar-menu').find('.active').each((i,e)=>{
                    $(e).removeClass('active');
                });
                $(e).parent().addClass("active");
            }
        });
    });
</script>