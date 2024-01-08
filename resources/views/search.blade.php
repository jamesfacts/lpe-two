@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  <div class="px-6 mt-8 max-w-1400 md:px-10 lg:pt-16 xl:pt-20 xl:px-16 ">
    <h1 class="uppercase text-4xl font-bold mb-4 mt-8 lg:text-6xl">
      @if (get_search_query())
        {!! 'Searching: ' . get_search_query() !!}
      @else 
        {!! 'Search' !!}
      @endif
    </h1>
    <h2 class="uppercase text-3xl font-bold tracking-tight leading-7 pl-4 lg:text-4xl">The Law and Political Economy Project</h2>

    @if (! have_posts())
      <div class="text-red-50 bg-red-400 p-3 text-center max-w-xs mx-auto my-8">
        {!! __('Sorry, no results were found.', 'sage') !!}
      </div>

      {!! get_search_form(false) !!}
    @endif
  </div>

  <div class="max-w-1400 px-6 my-16 grid sm:grid-cols-2 sm:gap-8 md:grid-cols-3 md:px-10 lg:grid-cols-2 xl:grid-cols-3 xl:px-16">
  @while(have_posts()) @php(the_post())
    @include('partials.content-search')
  @endwhile
  </div>

  <div class="px-6 max-w-1400 md:px-10 md:pb-10 lg:pb-16 xl:pb-32 xl:px-16">
  {!! get_the_posts_navigation() !!}
  </div>
@endsection
