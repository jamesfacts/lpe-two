
<div class="needed-for-animate-css-grid scroll-position h-full" id="{{$item->slug}}" :class="selected == {{$loop->index}} ? 'card--expanded' : ''" >
    <div class="bg-white rounded-panel h-full pt-8 pb-12 px-5 lg:px-7 xl:px-10 count_{{$count}} 
        @if($loop->index % 2 == 0)
            {{ 'even' }}
        @else
            {{ 'odd' }}
        @endif

        @if($item->future) {{"future-event"}} @else {{"past-event"}} @endif" style="transform-origin: 0px 0px 0px;" >
        <div class="inner-card h-full flex flex-col justify-between" >

            <div class="meta-wrap w-full max-w-3xl mx-auto">
                <div class="text-lg font-bold uppercase leading-none font-rubik tracking-tighter my-1">
                    {!!$item->date!!}
                </div>
                <h3 class="font-tiempos text-3xl mb-6">{!! $item->title !!}</h3>
                <span class="font-rubik text-xl">
                    {!! $item->panelists !!}
                </span>
            </div>
            <div class="max-w-3xl mx-auto">
                <div class="registration-pills my-6">
                    <a href="javascript:void(0)" 
                        class="expansion-toggle border border-black rounded-full uppercase text-xs px-3 text-center py-2 inline-block hover:text-tahini-500 hover:border-tahini-500" 
                        aria-label="Read / Close Full Event Description" @click="selected !== {{$loop->index}} ? selected = {{$loop->index}} : selected = null" x-text="selected ? 'Close Description' : 'Learn More'">
                        
                    </a>
                    
                    @if($item->future && $item->registration_url)
                        <a href="{{$item->registration_url}}" class="btn">Register for Event</a>
                    @endif
                    @if($item->discussion_url)
                        <a href="{{$item->discussion_url}}" class="btn">Join the Conversation</a>
                    @endif

                </div>

                <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" 
                            x-ref="container{{$loop->index}}" x-bind:style="selected == {{$loop->index}} ? 'max-height: ' + $refs.container{{$loop->index}}.scrollHeight + 'px' : ''">
                    <div class="opacity-controls">
                        <div class="event-body">
                            {!! $item->content !!}

                            @if($item->conference_video)
                                <div class="video-wrap">
                                {!! $item->conference_video !!}
                                </div>
                            @endif
                        </div>
                    

                        <div class="mt-8">
                            <button class="close-panel block ml-auto hover:text-tahini-500" @click="selected !== {{$loop->index}} ? selected = {{$loop->index}} : selected = null">
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
    </div>
</div>