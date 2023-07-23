@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-header')
    <div class="max-w-1400 p-6">
      @includeFirst(['partials.content-page', 'partials.content'])
    </div>
  @endwhile
@endsection
