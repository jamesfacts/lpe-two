@extends('layouts.app')

@section('content')

    @if( !is_paged() )
        @if($featuredEvents)
            <section class="flex flex-wrap px-10 max-w-1400">
                <aside class="w-1/4">
                    <h1>Featured events</h1>
                </aside>
                <div class="w-3/4">
                    @foreach($featuredEvents as $featuredEvent)
                        <article class="">
                            <div class="w-full">
                                <a href="{{ $featuredEvent->url }}">
                                    <img src="{{ $featuredEvent->img_url }}" alt="{{ $featuredEvent->alt }}">
                                </a>
                            </div>
                            <div class="w-full flex">
                                <div class="w-1/6">
                                    <span>{{ $featuredEvent->event_start_date }}</span>
                                </div>
                                <div class="w-3/6">
                                    <h2>{{ $featuredEvent->venue_title }}</h2>
                                </div>
                                <div class="w-2/6">
                                    <p>{!! $featuredEvent->excerpt !!}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
        <section class="featured bg-beige-200">
            <h2>receive event updates</h2>
            @include('components/horz-event-email')
        </section>
        <section class="upcoming">
            @dump($upcomingEvents)
        </section>
        
        <section class="bg-tahini-500">
            <div class="max-w-1400 flex flex-wrap px-10">
                <aside class="w-1/4">
                    <h1>Past events</h1>
                </aside>
                <div class="w-3/4 grid grid-cols-3 gap-8">
                    @if($pastEvents)
                        @foreach($pastEvents as $event)
                            @include('partials.content-lpe_event', ['event' => $event])
                        @endforeach
                    @endif
                </div>
                <div class="w-full bg-white">
                    Button here
                </div>
            </div>
        </section>

    @else
        <div class="w-full flex flex-col mb-32 max-w-1400 lg:flex-row lg:pt-10">
            <aside class="px-5 max-w-lg mx-auto mb-12 md:mx-10 md:mt-5 lg:mx-0 lg:w-1/3 lg:mx-4">
                @include('partials.archive-header', ['archive_page_slug' => $archiveSlugCheck])
            </aside>
            <div class="w-full grid gap-6 mt-6 sm:grid-cols-2 mr-5 md:w-2/3 md:ml-10 xl:grid-cols-3">
                @while(have_posts()) @php(the_post())
                    @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
                @endwhile
                {!! get_the_posts_navigation() !!}
            </div>
        </div>
    @endif

@endsection

