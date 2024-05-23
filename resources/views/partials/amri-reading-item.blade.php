@if($item->is_hed)
    <h3 class="font-rubik text-2xl uppercase font-bold mb-6 mt-16 leading-6 sm:mt-24 lg:mt-0">{!! $item->title !!}</h3>
@else
    <article class="flex reading-item mb-8 pb-4 border-b border-black" data-reading="{{$item->data_tag}}" >
        <div class="reading-lh w-3/4 pr-4">
        <a class="reading-item-text hover:underline" href="{{ $item->url }}">
            <span class="title text-2xl font-tiempos leading-6 font-bold tracking-lil-tight">{!! $item->title !!}</span>
            <span class="subtitle text-2xl font-tiempos leading-6 tracking-lil-tight">{!! " " . $item->subtitle !!}</span>
        </a>
        <span class="authors block font-thin mt-1">{!! $item->authors !!}</span>
        @if($item->notes)
            <span class="notes">{{ "• " . $item->notes }}</span>
        @endif
        </div>
        <div class="progress-tracker w-1/4 flex flex-col justify-center items-center">
        <button></button>
        <span class="reading-status font-necto uppercase text-center block" style="font-size:12px;">Not Started</span>
    </div>
    </article>
@endif
