@extends('layouts.app')

@section('content')
  <section class="w-full">
    <h1 class="py-10 uppercase font-rubik text-4xl font-bold text-center lg:text-left lg:pl-10 xl:py-16 xl:text-5xl xl:tracking-tighter xl:pl-16">LPE Blog</h1>
  </section>
  
  @if(get_query_var('paged') == 0 && $homeFeaturedBlog)
    <section class="bg-tahini-500">
      @foreach ($homeFeaturedBlog as $featured_post)
        <div class="max-w-screen-2xl lg:flex lg:flex-row lg:pb-16">
          <div class="h-72 max-w-2xl mx-auto sm:h-120 sm:pt-8 lg:w-1/2 lg:py-12 lg:pl-12 xl:h-150 xl:mx-0">
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
          <article class="py-6 mx-auto max-w-sm sm:py-12 md:max-w-lg lg:w-1/2 lg:px-12 xl:max-w-xl xl:ml-0">
            <h1 class="text-3xl font-bold uppercase font-rubik tracking-tighter leading-none mb-3 xl:text-5xl">
              <a href="{!! $featured_post->url !!}">{!! $featured_post->title !!}</a>
            </h1>
            
            @include('partials/fixed-authors', ['featured_id' => $featured_post->post_id])
            <p class="featured-snippet">{!! $featured_post->excerpt !!}</p>
            <a href="{!! $featured_post->url !!}" class="border border-black rounded-full uppercase text-xs px-3 text-center py-2 inline-block mt-4 hover:bg-black hover:text-white hover:!border-black" aria-label="Full post: {{ $featured_post->title }}">Continue Reading</a>
          </article>  
        </div>
      @endforeach
    </section>
  
    <section class="bg-gray-200">
      <div class="max-w-1400 p-8 flex flex-col-reverse lg:pl-12 lg:flex-row lg:py-12">
        <aside class="pl-4 max-w-xl lg:pl-0 lg:w-1/3 lg:pr-8 xl:w-1/4 xl:mr-6">
          <h1 class="font-bold text-4xl mb-4">EXPLORE</h1>
          @include('sections.sidebar')
        </aside>
        <div class="lg:w-2/3 xl:w-3/4">
          @if($stickyPosts)
          <section class="mx-4 sm:mx-0 max-w-1400">
            <span class="border-t border-black text-left w-full block uppercase my-4">Featured</span>
          </section>
          @endif
            <div class="md:grid md:grid-cols-2 md:gap-6 md:mb-6 xl:grid-cols-3">
              @if($stickyPosts)
                @foreach ($stickyPosts as $stickyPost)
                  @include('partials.content-post-sticky')            
                @endforeach
              @endif
            </div>
        </div>
      </div>
    </section>
    <section class="p-8 max-w-1400 lg:pl-10 lg:py-12">
      <div class="lg:w-2/3 lg:ml-auto xl:pl-6 xl:w-3/4 ">
          <section class="mx-4 sm:mx-0 max-w-1400">
            <span class="border-t border-black text-left w-full block uppercase my-4">Recent</span>
          </section>

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
  @else
    <section class="max-w-1400 p-8 flex flex-col-reverse lg:pl-12 lg:flex-row lg:py-12">
      <aside class="pl-4 max-w-xl lg:w-1/3 lg:pr-8 xl:w-1/4">
        <h1 class="font-bold text-4xl ">EXPLORE</h1>
        @include('sections.sidebar')
      </aside>
      <div class="lg:w-2/3 xl:w-3/4">
          @if(get_query_var('paged') == 0)
            <section class="mx-4 sm:mx-0 max-w-1400">
              <span class="border-t border-black text-left w-full block uppercase my-4">Recent</span>
            </section>
          @endif
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


  @if($mastheadMembers)
  <section class="bg-black">
    @include('partials.masthead')
  </section>
  @endif
  <section class="p-8 max-w-1400 lg:p-12 xl:p-24 xl:pl-32 xl:pr-8">
    @include('partials.searchbar')
  </section>
@endsection
