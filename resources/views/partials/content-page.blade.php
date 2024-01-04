<div class="hidden basis-full lg:p-12 lg:block">
    <h1 class="uppercase text-6xl font-bold ">{!! $title !!}</h1>
</div>
<div class="flex flex-col lg:grid lg:grid-cols-4 lg:px-12 lg:pt-8">
    <h1 class="uppercase text-4xl font-bold lg:hidden lg:basis-full">{!! $title !!}</h1>
    <div class="lg:col-span-1">
        
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
    <section class="page-content prose leading-6 pb-28 lg:col-span-3">
        @php(the_content())
    </section>
</div>
