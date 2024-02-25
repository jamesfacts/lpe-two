@php
    $contact_array = explode("@", get_field('email_address'));
@endphp

<header style="margin-left: -2px;">
  @if($featuredHeaderImage)
    <span class="block w-full h-full" style="background-color: #003837;">
        <figure class="h-[420px] bg-center bg-no-repeat bg-cover" style="background-image: url( '{!! $featuredHeaderImage['url'] !!}' )">
        </figure>
    </span>
  @endif

  <div class="mx-4 pt-2 sm:mx-8 lg:mx-12 lg:pt-14 max-w-xl">
    <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-1 lg:text-[2.8rem] lg:leading-10 lg:mb-4 lg:tracking-tight">{!! get_the_title() !!}</h1>
    <span class="lpe-contrib black-outline text-3xl font-bold uppercase font-rubik tracking-tight leading-none">{!! get_field('home_base') !!}</span>
  </div>

</header>

<section class="mx-4 flex flex-col-reverse mt-4 mb-16 sm:mx-8 lg:flex-row lg:ml-8 lg:pt-12">
  <div class="lg:mt-8 lg:mx-4 lg:flex lg:flex-col lg:justify-between lg:w-[220px] xl:w-[250px]">
    <div class="">
      <a class="generic-button no-underline" href="{{home_url('/speakers/')}}" aria-label="View All Speakers">
          View All Speakers
      </a>
    </div>
  </div>    

  <article @php post_class('mt-8 max-w-[640px] lg:pl-12') @endphp >
    <div class="">
      @php the_content() @endphp
    </div>
    <div class="mt-10 mb-10">
        <a class="generic-button no-underline" id="botanica"
           href="#" aria-label="Contact an LPE Speaker"
           @if(!empty($contact_array))
                data-alpha="{!! array_pop($contact_array) !!}"
                data-omega="{!! array_pop($contact_array) !!}"
            @endif >
            Contact {!! get_the_title() !!}
        </a>
    </div>
  </article>

</section>
