<article class="max-w-sm {{ (!$item->clickable) ? 'greyed-out' : 'live' }}" >
    <img src="{{ \Roots\asset( 'images/' . $item->img )}}">
    <h4 class="font-tiempos text-2xl mt-4 mb-2 pr-6" >
        <a href="{{ ($item->clickable) ? (home_url('/symposia/') . $item->slug) : 'javascript:void(0)' }}" class="hover:text-tahini-500">{!! $item->title !!}</a>
    </h4>

    @if($item->features)
        <span class="uppercase font-bold text-lg tracking-tight">Featuring</span>
        <p>{!! $item->features !!}</p>
    @endif

    <a href="{{ ($item->clickable) ? (home_url('/symposia/') . $item->slug) : 'javascript:void(0)' }}"
       class="flex justify-between items-center p-2 text-sm border-black border w-32 font-necto uppercase leading-none mt-5 hover:text-tahini-500 hover:border-tahini-500">
        Read More
    <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M7.24528 1L16 8.79487M16 8.79487L7.24528 17M16 8.79487H0" stroke="currentColor"/>
    </svg>                
    </a>
</article>