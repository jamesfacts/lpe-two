

<div class="bg-white rounded-panel card panel-card count_{{$count}} 
    @if($item->future) {{"future-event"}} @else {{"past-event"}} @endif" id="{{$item->slug}}">
    <div class="needed-for-animate-css-grid inner-card" style="transform-origin: 0px 0px;">

        <div class="meta-wrap">
            <div class="eyebrow-hed">
                @dump($item->date)
            </div>
            <h3>{!! $item->title !!}</h3>
            <span class="panelists">
                {!! $item->panelists !!}
            </span>
        </div>
        <div class="registration-pills">
            <a href="javascript:void(0)" class="btn learn-more" aria-label="Read Full Event Description">Learn More</a>
            <a href="javascript:void(0)" class="btn learn-less" aria-label="Read Full Event Description">Close Description</a>
            
            @if($item->future && $item->registration_url)
                <a href="{{$item->registration_url}}" class="btn">Register for Event</a>
            @endif
            @if($item->discussion_url)
                <a href="{{$item->discussion_url}}" class="btn">Join the Conversation</a>
            @endif

        </div>

        <div class="description-reveal">
            <div class="opacity-controls">
            {!! $item->content !!}
                <div class="close-panel-wrap">
                    <button class="close-panel">
                        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 35L0.999997 1M0.999997 1L35 35M0.999997 1L18 1L35 1" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <span class="sr-only">Close Panel Information</span>
                    </button>
                </div>
            </div>
        </div>
        
    </div>
</div>
