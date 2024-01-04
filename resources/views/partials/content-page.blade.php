<div class="flex flex-col">
    <div class="order-2 mb-3">
        <h1 class="uppercase text-4xl font-bold">{!! $title !!}</h1>
        @isset($our_team_title)
            <span class="necto our-team-title d-block">{!! $our_team_title !!}</span>
        @endisset
    </div>
    <div class="order-1">
        
        @if($aboutNavigation && $showMenu)
            <h2 class="text-4xl uppercase font-bold">{!! wp_get_nav_menu_name('about_navigation') !!}</h2>
            
            <ul class="mt-2 mb-8">
            @foreach ($aboutNavigation as $item)
            <li class="">
                <a href="{{ $item->url }}" class="text-2xl uppercase font-semibold leading-6 hover:text-tahini-500">
                {{ $item->label }}
                </a>
            </li>
            @endforeach
        </ul>
        @endif
        
    </div>
    <section class="page-content order-3 prose leading-6 pb-28">
        @php(the_content())
    </section>
</div>
