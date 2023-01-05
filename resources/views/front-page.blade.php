@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
  <section class="">
    <figure class=""
      style="background-image: url( {!! $frontHero !!} ); width: 100%; height: 600px;">
      <h1 class="">
        <img class="" src="{{ \Roots\asset('images/LPE_Wordmark_White.svg') }}" alt="Law & Political Economy" />
      </h1>
    </figure>
  </section>

  <section class="">
    
      <img src="{{\Roots\asset('images/homepage-separator.png')}}" />
      
  </section>
  <section>
    @if($blogFeed)
        @foreach($blogFeed as $item)
        <article class="">
            <span class="">{{ $item->content_type }}</span>
            <h4 class="">
                <a href="{{ $item->url }}">{!! $item->title !!}</a>
            </h4>
            <p class="excerpt">{!! $item->excerpt !!}</p>
        </article> 
        @endforeach
    @endif
  </section>

  @endwhile
@endsection
