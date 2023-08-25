@extends('layouts.app')

@section('content')

    @if( !is_paged() )
        <section class="py-5"></section>
        @if($featuredEvents)
            <section class="flex flex-col px-10 max-w-1400 pb-16 lg:flex-wrap lg:flex-row lg:pt-6">
                <aside class="w-full flex flex-col-reverse lg:w-1/4 lg:flex-col">
                    <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none my-4 lg:leading-8 xl:text-5xl">Featured events</h1>
                    <ul class="">
                        <li><a href="" class="text-2xl font-bold uppercase leading-none hover:text-tahini-500 font-rubik tracking-tighter my-3 lg:leading-none lg:text-2xl">Upcoming Events</a></li>
                        <li><a href="" class="text-2xl font-bold uppercase leading-none hover:text-tahini-500 font-rubik tracking-tighter my-3 lg:leading-none lg:text-2xl">Past Events</a></li>
                    </ul>
                </aside>
                <div class="w-full lg:w-3/4 lg:pl-16">
                    @foreach($featuredEvents as $featuredEvent)
                        <article class="max-w-md lg:max-w-lg xl:max-w-2xl">
                            <div class="w-full">
                                <div class="lg:hidden">
                                    <h2 class="">
                                        <a href="{{ $featuredEvent->url }}" class="text-xl font-bold uppercase leading-none hover:text-tahini-500 font-rubik tracking-tighter mb-3 mt-5 block lg:leading-none">{{ $featuredEvent->title }}</a>
                                    </h2>
                                    <span class="font-necto">{{$featuredEvent->event_start_date}}</span>
                                </div>
                                <a href="{{ $featuredEvent->url }}">
                                    <img src="{{ $featuredEvent->img_url }}" alt="{{ $featuredEvent->alt }}" class="my-4 w-full">
                                </a>
                            </div>
                            <div class="w-full flex flex-col-reverse xl:flex-row-reverse">
                                <div class="w-full xl:w-2/6 xl:pl-8">
                                    <span class="text-xl font-semibold uppercase leading-none block mt-5 mb-1 font-rubik tracking-tighter">Location: </span>
                                    {{ $featuredEvent->venue_title }}
                                </div>
                                <div class="w-full xl:w-3/6">
                                    <h2 class="hidden xl:block">
                                        <a href="{{ $featuredEvent->url }}" class="text-3xl font-bold uppercase leading-none hover:text-tahini-500 font-rubik tracking-tighter mb-3 mt-2 block lg:leading-7">{{ $featuredEvent->title }}</a>
                                    </h2>
                                    <p>{!! $featuredEvent->excerpt !!}</p>
                                </div>
                                <div class="hidden lg:block xl:w-1/6">
                                    <span class="font-necto text-lg">{{ $featuredEvent->event_start_date }}</span>
                                    <h2 class="xl:hidden">
                                        <a href="{{ $featuredEvent->url }}" class="text-3xl font-bold uppercase leading-none hover:text-tahini-500 font-rubik tracking-tighter mb-3 mt-2 block lg:leading-7">{{ $featuredEvent->title }}</a>
                                    </h2>
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

