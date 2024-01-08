@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (! have_posts())
    <div class="p-10 max-w-xl md:p-16 lg:max-w-6xl lg:px-32">
      <img class="mx-auto pb-20" src="{{ \Roots\asset('images/fat-cat.jpg') }}" alt="404 illustration" />
      <h2 class="bg-yellow-200 py-12 md:px-12 uppercase text-xl font-bold leading-6 text-center">
        {!! __('Sorry, but the page you were trying to view does not exist. Perhaps you can find it by searching:', 'sage') !!}
      </h2>  
    </div>

    {!! get_search_form(false) !!}
  @endif
@endsection
