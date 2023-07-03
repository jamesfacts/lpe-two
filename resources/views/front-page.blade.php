@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
  @if($frontHero)
    <section class="">
        <figure class="w-full h-150 lg:h-168 xl:h-200"
        style="background-image: url( {!! $frontHero->url !!} );">
        <h1 class="flex justify-around h-full">
            <img class="w-3/4 max-w-5xl xl:mr-auto xl:ml-36" src="{{ \Roots\asset('images/LPE_Wordmark_White.svg') }}" alt="Law & Political Economy" />
        </h1>
        </figure>
    </section>
  @endif
  
  <section class="mx-4 my-12 sm:mx-8 max-w-1400 lg:flex lg:flex-row lg:mb-32 xl:mx-32 xl:mt-20">
    <h2 class="text-4xl uppercase font-rubik font-bold leading-1 inline-block mb-4 lg:max-w-xs lg:leading-10 lg:text-5xl xl:text-6xl xl:mr-6 xl:leading-12">
      LPE project
    </h2>
    <article>
      <div class="lpe-intro-excerpt font-rubik mb-6 leading-6" style="max-width: 650px;">
        @php(the_content())
      </div>
      <a class="border border-black rounded-full uppercase font-rubik text-xs px-3 text-center py-2" href="{{ home_url('/about') }}" aria-label="Continue Reading the LPE introduction">About The LPE Project</a>
      <a class="border border-black rounded-full uppercase font-rubik text-xs px-3 text-center py-2 ml-5" href="{{ get_post_type_archive_link( 'post' ) }}" aria-label="Read the LPE blog">Read the LPE Blog</a>
    </article>
  </section>

  <section class="mx-4 sm:mx-8 max-w-1400 xl:ml-32">
    <span class="border-t border-black text-left w-full block uppercase mt-4 pt-4">Our Work</span>
  </section>
  

  @if($pageBlurbs)
    <div class="grid grid-cols-1 mb-6 mx-4 mt-2 mb-16 max-w-1400 sm:mx-8 md:grid-cols-2 md:gap-8 lg:grid-cols-3 xl:ml-32 xl:gap-20 xl:mb-32">
      @foreach($pageBlurbs as $blurb)
        <div class="mb-10">
            <h2 class="font-rubik font-bold uppercase text-2xl lg:text-3xl mb-6">{!! $blurb->title !!}</h2>
            <p class="mb-6">{!! $blurb->text !!}</p>
            <a href="{!! $blurb->url !!}" class="border border-black rounded-full uppercase font-rubik text-xs px-3 text-center py-2">
              Go to {{ $blurb->title }}
            </a>
        </div>
      @endforeach
    </div>
  @endif

  <section class="">
    <div class="bg-tahini-500">
      <figure style="background-image: url({{\Roots\asset('images/homepage-separator.png')}})" class="h-24 lg:h-48">
      </figure>
    </div>
  </section>

  <section class="mx-4 sm:mx-8 max-w-1400 xl:ml-32">
    <span class="border-t border-black text-left w-full block uppercase mt-4 pt-4">Recent Updates</span>
  </section>

  <section class="mx-4 my-12 sm:mx-8 max-w-1400 lg:flex lg:flex-row lg:mb-32 xl:mx-32 xl:mt-20">
    @if($blogFeed)
      <div class="w-full bg-indigo-100 md:w-2/3 lg:w-1/2 xl:w-2/3">
        @foreach($blogFeed as $item)
        <article class="">
            <span class="">{{ $item->content_type }}</span>
            <h4 class="">
                <a href="{{ $item->url }}">{!! $item->title !!}</a>
            </h4>
            <p class="excerpt">{!! $item->excerpt !!}</p>
        </article> 
        @if($loop->index === 1)
          </div>
          <div class="w-full md:w-1/3 lg:w-1/2 xl:w-1/3">
        @endif
        @endforeach
      </div>
    @endif
  </section>

  <section class="">
    {!! get_search_form(false) !!}
  </section>

  @endwhile
@endsection
