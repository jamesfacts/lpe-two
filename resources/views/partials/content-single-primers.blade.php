<header style="margin-left: -2px;">
  @if($featuredHeaderImage)
    <span class="block w-full h-full" style="background-color: #0085ff;">
        <figure class="h-[337px]" style="background-image: url( '{!! $featuredHeaderImage['url'] !!}' )">
        </figure>
    </span>
  @endif

  <div class="mx-4 pt-2 sm:mx-8 lg:mx-12 lg:pt-14 max-w-xl">
    <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-1 lg:text-[2.8rem] lg:leading-10 lg:mb-4 lg:tracking-tight">{!! get_the_title() !!}</h1>
    <span class="lpe-contrib black-outline text-4xl font-bold uppercase font-rubik tracking-tight leading-none">{!! get_field('syllabus_professor') !!}</span>
    <div class="">
      <span class="font-necto mr-6">Date added: <time class="font-necto" datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time></span>
    </div>
  </div>

</header>

<section class="mx-4 flex flex-col-reverse mt-4 mb-16 sm:mx-8 lg:flex-row lg:ml-8 lg:pt-12">
  <div class="lg:mt-8 lg:mx-4 lg:flex lg:flex-col lg:justify-between lg:w-[220px] xl:w-[250px]">

    <div class="">
      <a class="generic-button no-underline" href="{{home_url('/primers/')}}" aria-label="View All Primers">
          View All Primers
      </a>
    </div>

  </div>
  <article @php post_class('mt-8 max-w-[640px] lg:pl-12') @endphp>
    <div class="">
      @php the_content() @endphp
    </div>
    <div class="mt-10 mb-10">
        <a class="generic-button no-underline" 
           href="{{ get_field('syllabus_attachment') }}" aria-label="Download Primer">
           Download Primer
        </a>
    </div>
  </article>

</section>

