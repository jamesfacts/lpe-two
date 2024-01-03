{{--
  Template Name: Conference Template
--}}

@extends('layouts.app')

@section('content')
<div class="bg-black px-4 md:py-12 md:pt-8" x-data="{selected:null}">
  @while(have_posts()) @php(the_post())
    <div class="max-w-7xl rounded-panel bg-center bg-cover p-4 md:p-12" style="background-image: url( {{ \Roots\asset('images/conf-texture-bg.png') }} );">
        <div class="max-w-5xl">
            <h1 class="text-4xl leading-9 font-bold font-tiempos tracking-tight lg:text-7xl lg:leading-23">{!! $title !!}</h1>
            <h2 class="text-4xl mt-3 font-tiempos tracking-tight lg:text-7xl lg:leading-23">Spring 2023</h2>

            <div class="max-w-4xl mx-1 pr-4 mt-10 mb-12 lg:pr-8 lg:mt-16 conf-copy">
                @php(the_content())
            </div>
        </div>
    </div>
  @endwhile

  <section class="max-w-7xl">
    @if($panel_items)
      <div class="conference-panels grid grid-cols-1 gap-6 mt-6 overflow-hidden lg:grid-cols-2">
      @foreach($panel_items as $item)
        @if( $item->placeholder )
          @include('partials/conference-placeholder')
        @else
          @include('partials/conference-panel', ['item' => $item, 'count' => $loop->iteration])
        @endif
      @endforeach
      </div>
    @endif
  </section>
</div>

@endsection
