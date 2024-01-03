{{--
  Template Name: Conference Template
--}}

@extends('layouts.app')

@section('content')
<div class="bg-black px-4 lg:py-12 lg:pt-8" x-data="{selected:null}">
  @while(have_posts()) @php(the_post())
    <div class="max-w-7xl rounded-panel bg-center bg-cover p-4 sm:pt-8 md:p-12" style="background-image: url( {{ \Roots\asset('images/conf-texture-bg.png') }} );">
        <div class="max-w-5xl">
            <h1 class="text-4xl leading-9 font-bold font-tiempos tracking-tight sm:text-6xl sm:leading-16 md:text-7xl md:leading-18">{!! $title !!}</h1>
            <h2 class="text-4xl font-tiempos tracking-tight sm:text-6xl sm:leading-16 md:text-7xl md:leading-18 lg:mt-3">Spring 2023</h2>

            <div class="max-w-xl mx-1 pr-4 mt-10 mb-12 lg:max-w-4xl lg:pr-8 lg:mt-16 " x-data="{confExpanded:null}">
                <div class="conf-copy lg:hidden">
                  @php(the_content())
                </div>
                <div class="hidden lg:block">
                  <div class="" x-show="!confExpanded">
                    blah blah blah
                  </div>

                  <div class="grid grid-cols-2" x-show="confExpanded">
                    <div class="conf-copy text-lg">
                      @php(the_content())
                    </div>
                    
                  </div>  
                  <a href="javascript:void(0)" 
                          class="border border-black rounded-full uppercase text-xs px-3 text-center py-2 inline-block hover:text-tahini-500 hover:border-tahini-500" 
                          aria-label="Read / Close Full Conference Description" @click="confExpanded = ! confExpanded" x-text="confExpanded ? 'Close Description' : 'Learn More'">
                          
                  </a>
                </div>

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
