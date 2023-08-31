{{--
  Template Name: Learn Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <section>
      <div class="max-w-1400">
        <aside>
          @if (has_nav_menu('learn_navigation'))
            {!! wp_nav_menu(['theme_location' => 'learn_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
          @endif
        </aside>
        <div>
          <h1>{!! the_title() !!}</h1>
          <div>@php(the_content())</div>
          <div class="">
          @include('components/generic-btn', [ 'url' => home_url('/lpe-manifesto/'), 'copy' => 'Learn More' ])
          </div>
        </div>
      </div>
    </section>
    <section class="bg-beige-200">
      <div class="max-w-1400">
        <h2>LPE Videos</h2>
        <div class="">
          <div class="">@dump($lpeFeaturedVideo)</div>
          @if($lpeFeaturedVideo)
            <article>
            @if(@isset($lpeFeaturedVideo->img_url))
              @include('components/thumb-figure', [
                'aspect_ratio' => '65%', 
                'img_url' => $lpeFeaturedVideo->img_url, 
                'url' => $lpeFeaturedVideo->url, 
                'alt' => $lpeFeaturedVideo->alt
              ])
            @endif
            <h2>
              <a href="{!!$lpeFeaturedVideo->url!!}">{!!$lpeFeaturedVideo->name!!}</a>
            </h2>
            <span class="font-necto block">{!!$lpeFeaturedVideo->subtitle!!}</span>
            </article>
          @endif
          <div class="">
            @if($lpeVideos)
              @foreach($lpeVideos as $lpeVideo)
                <article>
                  @if(@isset($lpeVideo->img_url))
                    @include('components/thumb-figure', [
                      'aspect_ratio' => '65%', 
                      'img_url' => $lpeVideo->img_url, 
                      'url' => $lpeVideo->url, 
                      'alt' => $lpeVideo->alt
                    ])
                  @endif
                  <h3>{!! $lpeVideo->name !!}</h3>
                  <span class="font-necto">{!! $lpeVideo->subtitle !!}</span>
                </article>
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="max-w-1400">
        <aside>
          Syllabi blurb
        </aside>
        <div class="">
          @dump($lpeSyllabi)
        </div>
      </div>
    </section>
    <section class="bg-tahini-500">
      <div class="max-w-1400">
        <aside>
          Primers blurb
        </aside>
        <div class="">
          @dump($primerPosts)
        </div>
      </div>
    </section>
  @endwhile
@endsection
