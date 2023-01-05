@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
  @if($frontHero)
    <section class="">
        <figure class=""
        style="background-image: url( {!! $frontHero->url !!} ); width: 100%; height: 600px;">
        <h1 class="">
            <img class="" src="{{ \Roots\asset('images/LPE_Wordmark_White.svg') }}" alt="Law & Political Economy" />
        </h1>
        </figure>
    </section>
  @endif

  @if($pageBlurbs)
    @foreach($pageBlurbs as $blurb)
        <h2>{!! $blurb->title !!}</h2>
        <p>{!! $blurb->text !!}</p>
    @endforeach
  @endif
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

  <section class="">
    {!! get_search_form(false) !!}
  </section>

  @endwhile
@endsection
