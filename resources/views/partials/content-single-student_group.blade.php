
<header class="" style="margin-left: -2px;">
    @if($featuredHeaderImage)
        <span class="block w-full h-full" style="background-color: #c7dbe8;">
            <figure class="h-[420px] bg-center bg-no-repeat bg-cover" style="background-image: url( '{!! $featuredHeaderImage['url'] !!}' )">
            </figure>
        </span>
    @endif
    <div class="mx-5 mb-5 max-w-md sm:mx-10 lg:mt-16 lg:ml-12">
        <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-1 lg:mt-3 lg:text-5xl lg:mb-3 lg:leading-11">{!! get_the_title() !!}</h1>
        <div class="black-outline uppercase text-4xl font-bold">{!! get_field('school_affiliation') !!}</div>
    </div>

</header>

<section class="mx-4 flex flex-col-reverse mt-4 mb-16 sm:mx-8 lg:flex-row lg:ml-8 lg:pt-12">
  <div class="lg:mt-8 lg:mx-4 lg:flex lg:flex-col lg:justify-between lg:w-[220px] xl:w-[250px]">

    <div class="">
      <a class="generic-button no-underline" href="{{home_url('/student-groups/')}}" aria-label="View All Groups">
          View All Groups
      </a>
    </div>

  </div>
  <article @php post_class('mt-8 max-w-[640px] lg:pl-12') @endphp>
        <div class="">
            @php the_content() @endphp
        </div>
        @if(get_field('external_group_url'))
            <div class="mt-10 mb-10">
                <a class="generic-button no-underline" 
                href="{{ get_field('external_group_url') }}" aria-label="Visit Student Group Website">
                Download Primer
                </a>
            </div>
        @endif
    </article>

</section>
