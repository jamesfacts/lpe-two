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
          <div class="">@dump($lpeVideos)</div>
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
