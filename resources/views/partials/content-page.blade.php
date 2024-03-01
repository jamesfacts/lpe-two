<div class="hidden basis-full lg:p-12 lg:block">
    <h1 class="uppercase text-6xl font-bold max-w-md leading-13">{!! $title !!}</h1>
</div>
<div class="flex flex-col max-w-xl lg:flex-row lg:pl-12 lg:pr-2 lg:pt-2 lg:max-w-6xl">
    <aside class="lg:w-full lg:max-w-[260px] ">
        
        @if($aboutNavigation && $showMenu)
            <span class="text-4xl uppercase font-bold lg:leading-8">{!! wp_get_nav_menu_name('about_navigation') !!}</span>
            
            <ul class="mt-2 mb-8 lg:mt-6">
            @foreach ($aboutNavigation as $item)
            <li class="">
                <a href="{{ $item->url }}" class="text-2xl uppercase font-semibold leading-6 hover:text-tahini-500">
                {{ $item->label }}
                </a>
            </li>
            @endforeach
        </ul>
        @endif
        
    </aside>
    <h1 class="uppercase text-4.5xl font-bold lg:hidden lg:basis-full">{!! $title !!}</h1>
    <section class="page-content pb-28 w-full lg:max-w-[620px] xl:pl-16">
        @php(the_content())
    </section>
</div>
