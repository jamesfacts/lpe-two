@php
    $contact_array = explode("@", get_field('email_address'));
@endphp

<header style="margin-left: -2px;">
  @if($featuredHeaderImage)
    <span class="block w-full h-full" style="background-color: #003837;">
        <figure class="h-[367px]" style="background-image: url( '{!! $featuredHeaderImage['url'] !!}' )">
        </figure>
    </span>
  @endif

  <div class="mx-4 sm:mx-8 max-w-xl lg:px-16 lg:pt-12">
    <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-1">{!! get_the_title() !!}</h1>
    <span class="lpe-contrib black-outline text-3xl font-bold uppercase font-rubik tracking-tight leading-none">{!! get_field('home_base') !!}</span>
  </div>

</header>

<section class="mx-4 sm:mx-8 mb-32 lg:flex lg:flex-row lg:px-16 lg:pt-16">
  <div class="mt-8 lg:w-[220px]">
    <a class="generic-button no-underline" href="{{home_url('/speakers/')}}" aria-label="View All Speakers">
      View All Speakers
    </a>
  </div>    

  <article @php post_class('mt-8 prose pl-6 lg:mt-2') @endphp >
    <div class="entry-body">
      @php the_content() @endphp
    </div>
    <div class="mt-10 mb-0">
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

