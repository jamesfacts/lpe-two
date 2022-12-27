@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
  {{"hi i'm a page"}}
    @include('partials.page-header')
    @includeFirst(['partials.content-page', 'partials.content'])
  @endwhile
@endsection
