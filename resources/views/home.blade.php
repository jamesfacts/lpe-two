@extends('layouts.app')

@section('content')
  <section class="w-full">
    <h1 class="py-10 uppercase font-rubik text-4xl font-bold text-center lg:text-left lg:pl-10 xl:py-16 xl:text-5xl xl:tracking-tighter xl:pl-16">LPE Blog</h1>
  </section>
  
  @if(get_query_var('paged') == 0 && $homeFeaturedBlog)
    <section class="bg-tahini-500">
      @foreach ($homeFeaturedBlog as $featured_post)
        <div class="max-w-screen-xl lg:flex lg:flex-row lg:pb-16">
          <div class="h-72 sm:h-96 lg:w-3/5">
            @if(@isset($featured_post->img_url))
              <figure class="img-fill"
                style="background-image: url( {!! $featured_post->img_url !!} );" aria-label="{{ $featured_post->image_alt }}">
                <a href="{!! $featured_post->url !!}" class="anchor-fill">
                  <span class="sr-only">{!! $featured_post->title !!}</span>
                </a>
              </figure>
            @endif
            <span class="sr-only">{!! $featured_post->title !!}</span>
          </div>
          <article class="py-6 mx-auto max-w-sm sm:py-12 md:max-w-lg lg:w-2/5 lg:pr-12">
            <h1 class="text-3xl font-bold uppercase font-rubik tracking-tighter leading-none mb-3">
              <a href="{!! $featured_post->url !!}">{!! $featured_post->title !!}</a>
            </h1>
            
            @include('partials/fixed-authors', ['featured_id' => $featured_post->post_id])
            <p class="featured-snippet">{!! $featured_post->excerpt !!}</p>
            <a href="{!! $featured_post->url !!}" class="border border-black rounded-full uppercase text-xs px-3 text-center py-2 inline-block mt-4" aria-label="Full post: {{ $featured_post->title }}">Continue Reading</a>
          </article>  
        </div>
      @endforeach
    </section>
  @endif
 
  @if (! have_posts())
    <x-alert type="warning">
      {!! __('Sorry, no results were found.', 'sage') !!}
    </x-alert>
  @else
  <section class="max-w-1400 p-8 flex flex-col-reverse lg:pl-12 lg:flex-row lg:py-12">
    <aside class="lg:w-1/3 lg:pr-8 xl:w-1/4">
      <h1 class="font-bold text-4xl ">EXPLORE</h1>
      @include('sections.sidebar')
    </aside>
    <div class="lg:w-2/3 xl:w-3/4">
      <div class=" md:grid md:grid-cols-2 md:gap-6 xl:grid-cols-3">
        @while(have_posts()) @php(the_post())
          @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
        @endwhile
      </div>
      <div class="">
        {!! get_the_posts_navigation() !!}
      </div>
    </div>
  </section>

  @endif

@endsection
