@php
    $contact_array = explode("@", get_field('email_address'));
@endphp

<header style="margin-left: -2px;">
  @if($featuredHeaderImage)
    <span class="block w-full h-full" style="background-color: #003837;">
        <figure class="h-100" style="background-image: url( '{!! $featuredHeaderImage['url'] !!}' )">
        </figure>
    </span>
  @endif

  <div class="mx-4 lg:mx-8 max-w-xl">
    <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-1">{!! get_the_title() !!}</h1>
    <span class="lpe-contrib black-outline text-4xl font-bold uppercase font-rubik tracking-tight leading-none">{!! get_field('home_base') !!}</span>
  </div>

</header>

<section class="mx-4 flex flex-col-reverse mb-32 lg:flex-row">
  <div class="lg:mt-12 lg:ml-4 lg:mr-16 lg:flex lg:flex-col lg:justify-between">
    <div class="hidden lg:block">
      @include('partials.entry-author-bio')
      <span class="py-3 lg:block"></span>
      
    </div>
    <div class="">
      @include('components.share', ['parent_view' => 'Single'])
      <span class="py-2 block"></span>
      @include('partials.entry-author-bio')
    </div>
  </div>
  <article @php post_class('mt-8 prose') @endphp>
    <div class="">
      @php the_content() @endphp
    </div>
    <div class="mt-10 mb-40">
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

