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

            <div class="max-w-xl mx-1 pr-4 mt-10 mb-12 lg:max-w-4xl lg:pr-8 lg:mt-16 xl:max-w-6xl" x-data="{confExpanded:null}">
                <div class="conf-copy lg:hidden">
                  @php(the_content())
                </div>
                <div class="">

                  <div class="grid lg:grid-cols-2 lg:gap-10">
                    <div class="hidden conf-copy lg:block lg:text-lg" x-show="!confExpanded">
                      @php(the_excerpt())
                    </div>
                    <div class="hidden conf-copy lg:block lg:text-lg" x-show="confExpanded">
                      @php(the_content())
                    </div>

                    <div class="mb-6 conf-copy lg:text-lg">
                      @if(get_field('email_blurb'))
                        <p class="pb-6 block">
                          {!! get_field('email_blurb') !!}
                        </p>
                      @endif
                      <h3 class="uppercase font-bold text-lg tracking-tight">Subscribe For Updates</h3>
                      @include('components/horz-event-email')
                    </div>

                  </div>  
                  <a href="javascript:void(0)" 
                          class="hidden lg:inline-block border border-black rounded-full uppercase text-xs px-3 text-center py-2 hover:text-tahini-500 hover:border-tahini-500" 
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
