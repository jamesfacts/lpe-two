@extends('layouts.app')

@section('content')
  <section class="row">
    <div class="col-lg-5">
      <h1 class="blog-title">LPE Blog</h1>
    </div>
  </section>
  
  @dump($homeFeaturedBlog)
 
  @if (! have_posts())
    <x-alert type="warning">
      {!! __('Sorry, no results were found.', 'sage') !!}
    </x-alert>
  @endif

  @while(have_posts()) @php(the_post())
    @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
  @endwhile

  {!! get_the_posts_navigation() !!}
@endsection

@section('sidebar')
  @include('sections.sidebar')
@endsection
