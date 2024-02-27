<header class="px-4 lg:pl-8 lg:pt-12 xl:pl-16 xl:pt-20">
  <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-4 max-w-md 
             lg:text-4.5xl lg:leading-10 lg:max-w-2xl lg:pr-18 lg:tracking-tight">{!! get_the_title() !!}</h1>
    <span class="lpe-contrib black-outline text-4xl font-bold uppercase font-rubik tracking-tight leading-none lg:text-4.5xl">
        {{$eventStartDate}}
    </span>
</header>

<section class="mx-4 flex flex-col-reverse mb-32 lg:flex-row">
  <div class="lg:mt-8 lg:mx-4 lg:flex lg:flex-col lg:justify-between lg:w-[220px] xl:max-w-sm xl:pr-0 xl:mr-0 xl:pl-8 xl:w-[250px]">
    <div class="mb-16">
      <h2 class="text-3xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-1 max-w-md lg:text-4xl lg:mt-0">Location:</h2>
        @if( get_field('venue_title') )<span>{!! get_field('venue_title') !!}</span>@endif
        @if( get_field('venue_street_address') )<span>{!! get_field('venue_street_address') !!}</span>@endif
        @if( get_field('venue_city_state') )<span>{!! get_field('venue_city_state') !!}</span>@endif

      @if( get_field('event_time') )
        <h2 class="text-3xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-1 max-w-md lg:leading-8 lg:text-4xl ">Time of Event:</h2>
          @if( get_field('event_day_of_the_week') ) 
            <span>{{ get_field('event_day_of_the_week') }}</span> 
          @endif
          @if( get_field('event_time') ) 
            <span>{{ get_field('event_time') }}</span> 
          @endif
      @endif
    </div>
    <div class="my-10 lg:hidden">
        <a class="generic-button no-underline" href="{{home_url('/events/')}}" aria-label="View All Events">
            Back to the All Events
        </a>
    </div>
    <div class="">
      @include('components.share', ['parent_view' => 'Single'])
    </div>
  </div>

  <article @php post_class('mt-8 max-w-[640px] lg:pl-12 lg:pr-8 xl:pl-20 xl:pr-0 xl:max-w-2xl') @endphp>
    <div class="body-content">
      @php the_content() @endphp
    </div>
    <div class="hidden mt-14 mb-2 lg:block">
        <a class="generic-button no-underline" href="{{home_url('/events/')}}" aria-label="View All Events">
            Back to the All Events
        </a>
    </div>
  </article>

</section>
