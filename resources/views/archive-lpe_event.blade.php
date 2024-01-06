@extends('layouts.app')

@section('content')

    @if( !is_paged() )
        <section class="py-5"></section>
        @if($featuredEvents)
            <section class="flex flex-col px-10 max-w-1400 pb-16 lg:flex-wrap lg:flex-row lg:pt-6">
                <aside class="w-full flex flex-col-reverse lg:w-1/4 lg:flex-col">
                    <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none my-4 lg:leading-8 ">Featured events</h1>
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
                                    <span class="font-necto block">{{$featuredEvent->event_start_date}}</span>
                                </div>
                                <a href="{{ $featuredEvent->url }}">
                                    <img src="{{ $featuredEvent->img_url }}" alt="{{ $featuredEvent->alt }}" class="my-4 w-full">
                                </a>
                            </div>
                            <div class="w-full flex flex-col-reverse mb-16 xl:flex-row-reverse">
                                <div class="w-full xl:w-2/6 xl:pl-8">
                                    <span class="text-xl font-semibold uppercase leading-none block mt-5 mb-1 font-rubik tracking-tighter">Location: </span>
                                    {!! $featuredEvent->venue_title !!}
                                </div>
                                <div class="w-full xl:w-3/6">
                                    <h2 class="hidden xl:block">
                                        <a href="{{ $featuredEvent->url }}" class="text-3xl font-bold uppercase leading-none hover:text-tahini-500 font-rubik tracking-tighter mb-3 mt-2 block lg:leading-7">{{ $featuredEvent->title }}</a>
                                    </h2>
                                    <p>{!! $featuredEvent->excerpt !!}</p>
                                </div>
                                <div class="hidden lg:block xl:w-1/6">
                                    <span class="font-necto text-lg block xl:mt-1">{{ $featuredEvent->event_start_date }}</span>
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
        <section class="p-10
            @if($upcomingEvents)
                {{' bg-tahini-500 '}}
            @else
                {{' bg-beige-200 '}}
            @endif
            ">
            <div class="max-w-1400 lg:flex">
                <aside class="hidden lg:w-1/4 lg:block">&nbsp;</aside>
            <div class="flex flex-col lg:w-3/4 lg:pl-16 xl:pl-10">
                <h2 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none my-4 lg:leading-8">receive<br/>event updates</h2>
                @include('components/horz-event-email')
            </div>
            </div>
        </section>
        @if(isset($upcomingEvents) && count($upcomingEvents)>0)
            <section class="upcoming bg-beige-200 pt-10">
                <div class="max-w-1400 px-10 lg:pt-8 lg:flex">
                    <aside class="w-full flex flex-col lg:w-1/4">
                        <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none my-4 lg:leading-8 ">Upcoming events</h1>
                    </aside>
                    <div class="w-full pb-10 lg:w-3/4 lg:pl-16">
                        @foreach($upcomingEvents as $upcomingEvent)
                            <article class="border-black border-t pb-10 max-w-xl xl:max-w-2xl">
                                <div class="w-full md:flex xl:flex-row-reverse">
                                    <div class="md:w-2/3">
                                        <span class="text-xl font-bold uppercase leading-none block pt-5 font-rubik tracking-tighter my-3 lg:leading-none lg:text-2xl xl:hidden">{{ $upcomingEvent->event_start_date }}</span>
                                        <h3><a href="{{ $upcomingEvent->url }}" class="text-2xl font-bold uppercase leading-none hover:text-tahini-500 font-rubik tracking-tighter block my-3 lg:leading-none lg:text-2xl xl:text-3xl xl:mt-6">
                                            {!! $upcomingEvent->title !!}</a>
                                        </h3>
                                        <p>{!! $upcomingEvent->excerpt !!}</p>
                                        <div class="hidden xl:block">
                                            <span class="text-xl font-semibold uppercase leading-none block mt-5 mb-2 font-rubik tracking-tighter">Location: </span>
                                            <span>{{ $upcomingEvent->venue_title }}</span>
                                        </div>
                                    </div>
                                    <div class="md:w-1/3 md:pl-8 xl:p-0">
                                        <div class="xl:hidden">
                                            <span class="text-xl font-semibold uppercase leading-none block mt-5 mb-1 font-rubik tracking-tighter">Location: </span>
                                            <span>{{ $upcomingEvent->venue_title }}</span>
                                        </div>
                                        <div class="hidden xl:block">
                                            <span class="text-2xl font-bold uppercase leading-none block pt-5 font-rubik tracking-tighter my-3">{{ $upcomingEvent->event_start_date }}</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ $upcomingEvent->url }}"><img src="{{ $upcomingEvent->img_url }}" alt="{{ $upcomingEvent->alt }}" class="pt-6 xl:pt-10"></a>
                                
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        
        <section class="bg-tahini-500">
            <div class="max-w-1400 flex flex-col px-6 pt-12 xl:flex-row xl:flex-wrap">
                <aside class="w-full px-4 pb-6 xl:w-1/4">
                <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none my-4 lg:leading-8 ">Past events</h1>
                </aside>
                <div class="w-full past-event-grid max-w-sm ml-0 mr-auto grid grid-cols-1 gap-2 md:max-w-full md:grid-cols-2 lg:grid-cols-3 lg:gap-8 lg:px-5 xl:w-3/4 xl:pl-18">
                    @if($pastEvents)
                        @foreach($pastEvents as $event)
                            @include('partials.content-lpe_event', ['event' => $event])
                        @endforeach
                    @endif
                </div>
                <div class="w-full archive-nav pl-5 md:ml-auto md:pl-16 lg:pl-6 xl:w-3/4 xl:pl-16 pt-12 pb-20">
                    @include('components/generic-btn', [ 'url' => $pastEventUrl, 'copy' => 'View All Past Events' ])
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

