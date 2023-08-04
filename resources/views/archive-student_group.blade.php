@extends('layouts.app')

@section('content')

  @if (! have_posts())
    <x-alert type="warning">
      {!! __('Sorry, no results were found.', 'sage') !!}
    </x-alert>

    {!! get_search_form(false) !!}
  @endif

  <div class="w-full flex flex-col mb-32 max-w-1400 lg:flex-row lg:pt-10">
    <aside class="px-5 max-w-lg mx-auto mb-12 md:mx-10 md:mt-5 lg:mx-0 lg:w-1/3 lg:mx-4">
      @if($joinStudentGroupCopy)
        <h1 class="text-3xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-4 lg:mt-3 lg:text-4xl">Start A Student Group</h1>
        {!! $joinStudentGroupCopy !!}
      @endif
    </aside>
    <div class="w-full grid gap-6 mt-6 sm:grid-cols-2 mr-5 md:w-2/3 md:ml-10 xl:grid-cols-3">
      @while(have_posts()) @php(the_post())
        @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
      @endwhile
    </div>
  </div>

@endsection