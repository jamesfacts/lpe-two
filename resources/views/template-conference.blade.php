{{--
  Template Name: Conference Template
--}}

@extends('layouts.app')

@section('content')
<div class="bg-black">
  @while(have_posts()) @php(the_post())
    <div class="max-w-7xl mt-12 rounded-panel p-12 bg-center bg-cover" style="background-image: url( {{ \Roots\asset('images/conf-texture-bg.png') }} );">
        <div class="max-w-5xl">
            <h1 class="text-7xl font-bold font-tiempos tracking-tight leading-23">{!! $title !!}</h1>
            <h2 class="text-7xl mt-3 font-tiempos tracking-tight leading-23">Spring 2023</h2>

            <div class="max-w-4xl mx-1 pr-8 mt-16 conf-copy">
                @php(the_content())
            </div>
        </div>
    </div>
  @endwhile

  @if($panel_items)
      @foreach($panel_items as $item)
          @include('partials/conference-panel', ['item' => $item, 'count' => $loop->iteration])
      @endforeach
  @endif
</div>
@endsection