<header class="px-4 lg:p-20">
  <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-1 max-w-md lg:text-5xl">{!! get_the_title() !!}</h1>
    <span class="lpe-contrib black-outline text-4xl font-bold uppercase font-rubik tracking-tight leading-none lg:text-5xl">
        {{$eventStartDate}}
    </span>
</header>

<section class="mx-4 flex flex-col-reverse mb-32 lg:flex-row">
  <div class="lg:mt-1 lg:pl-16 lg:pr-6 lg:flex lg:flex-col lg:justify-between">
    <div class="mb-16">
      <h2 class="text-3xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-1 max-w-md">Location:</h2>
      <span>{{get_field('venue_title')}}</span>
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

  <article @php post_class('mt-8 max-w-xl') @endphp>
    <div class="prose">
      @php the_content() @endphp
    </div>
    <div class="hidden mt-14 mb-2 lg:block">
        <a class="generic-button no-underline" href="{{home_url('/events/')}}" aria-label="View All Events">
            Back to the All Events
        </a>
    </div>
  </article>

</section>
