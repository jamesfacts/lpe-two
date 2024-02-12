{{--
  Template Name: Symposia Template
--}}

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
      @include('partials.archive-header', ['archive_page_slug' => 'symposia'])
    </aside>
    <div class="w-full grid gap-6 mt-6 sm:grid-cols-2 mr-5 md:w-2/3 md:ml-10 xl:gap-10 xl:grid-cols-3">
      @if($allSymposia)
        @foreach($allSymposia as $symposium)
          <article class="border-b border-black mb-5 pb-2">
          <h2 class="">
            <a href="{{ $symposium->url }}" 
              class="text-2xl font-bold uppercase leading-none hover:text-tahini-500 font-rubik tracking-tighter my-3 
                     lg:leading-none lg:text-3xl xl:text-2xl xl:leading-5">
              {!! $symposium->title !!}
            </a>
          </h2>
          <span class="block font-necto mt-2 mb-3">{{ $symposium->newest_post }}</span>
          
          @if(count($symposium->featuring) > 0 )
          <span class="uppercase font-semibold block my-2">Featuring:</span>
          <span class="mb-3 block">@foreach($symposium->featuring as $author){!! $author->name !!}@if(!($loop->last)){{ __(', ', 'sage') }}@endif @endforeach
          </span>
          @endif
          </article>
        @endforeach
      @endif
    </div>
  </div>

@endsection