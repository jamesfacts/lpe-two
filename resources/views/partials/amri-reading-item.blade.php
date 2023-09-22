@if($item->is_hed)
    <h3>{!! $item->title !!}</h3>
@else
    <article class="flex reading-item" data-reading="{{$item->data_tag}}" >
        <div class="reading-lh">
        <a class="reading-item-text" href="{{ $item->url }}">
            <span class="title">{!! $item->title !!}</span>
            <span class="subtitle">{!! " " . $item->subtitle !!}</span>
        </a>
        <span class="authors">{{ $item->authors }}</span>
        @if($item->notes)
            <span class="notes">{{ "• " . $item->notes }}</span>
        @endif
        </div>
        <div class="progress-tracker">
        <button></button>
        <span class="reading-status">Not Started</span>
    </div>
    </article>
@endif
