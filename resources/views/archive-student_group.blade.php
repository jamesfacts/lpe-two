@extends('layouts.app')

@section('content')

  @if (! have_posts())
    <x-alert type="warning">
      {!! __('Sorry, no results were found.', 'sage') !!}
    </x-alert>

    {!! get_search_form(false) !!}
  @endif

  <div class="w-full flex flex-row">
    <aside class="w-1/3 mx-5">
      @if($joinStudentGroupCopy)
        <h1 class="text-3xl font-bold uppercase font-rubik tracking-tighter leading-none my-3 lg:text-4xl">Start A Student Group</h1>
        {!! $joinStudentGroupCopy !!}
      @endif
    </aside>
    <div class="w-2/3 grid grid-cols-2 mr-5 xl:grid-cols-3">
      @while(have_posts()) @php(the_post())
        @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
      @endwhile
    </div>
  </div>

@endsection