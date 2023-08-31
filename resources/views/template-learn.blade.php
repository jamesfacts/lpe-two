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
    <section class="bg-beige-200 px-6 py-12 sm:px-8 lg:px-16 xl:px-24">
      <div class="max-w-1400">
        <h1 class="text-5xl font-bold uppercase leading-none 
                            font-rubik tracking-tighter mb-10 lg:leading-6 lg:mb-16">LPE Videos</h1>
        <div class="lg:flex lg:flex-row-reverse">
          @if($lpeFeaturedVideo)
            <article class="mb-8 max-w-xl lg:w-2/3 lg:max-w-3xl lg:ml-12 lg:mr-auto">
            @if(@isset($lpeFeaturedVideo->img_url))
              @include('components/thumb-figure', [
                'aspect_ratio' => '65%', 
                'img_url' => $lpeFeaturedVideo->img_url, 
                'url' => $lpeFeaturedVideo->url, 
                'alt' => $lpeFeaturedVideo->alt
              ])
            @endif
            <h2 class="mt-4 w-5/6">
              <a href="{!!$lpeFeaturedVideo->url!!}" class="text-2xl font-bold uppercase leading-none hover:text-tahini-500 block 
                                                        font-rubik tracking-tighter my-3 lg:leading-8 lg:text-4xl lg:mt-5">
                {!!$lpeFeaturedVideo->name!!}
              </a>
            </h2>
            <span class="font-necto block w-5/6">{!!$lpeFeaturedVideo->subtitle!!}</span>
            </article>
          @endif
          <div class="grid gap-6 sm:grid-cols-2 lg:w-1/3 lg:grid-cols-1 lg:mr-auto">
            @if($lpeVideos)
              @foreach($lpeVideos as $lpeVideo)
                <article class="mb-8">
                  @if(@isset($lpeVideo->img_url))
                    @include('components/thumb-figure', [
                      'aspect_ratio' => '65%', 
                      'img_url' => $lpeVideo->img_url, 
                      'url' => $lpeVideo->url, 
                      'alt' => $lpeVideo->alt
                    ])
                  @endif
                  <h3 class="mt-4 w-5/6">
                    <a href="{!! $lpeVideo->url !!}" class="text-2xl font-bold uppercase leading-none hover:text-tahini-500 
                                                        font-rubik tracking-tighter my-3 lg:leading-6">
                    {!! $lpeVideo->name !!}</a>
                  </h3>
                  <span class="font-necto">{!! $lpeVideo->subtitle !!}</span>
                </article>
              @endforeach
            @endif
          </div>
        </div>
      </div>
      <div class="flex max-w-1400">
        <div class="mt-10 mb-6">
          @include('components/generic-btn', [ 'url' => home_url('/videos/'), 'copy' => 'View All Videos' ])
        </div>
      </div>
    </section>
    <section class="px-6 py-12 sm:px-8 lg:px-16 xl:px-24">
      <div class="max-w-1400 xl:flex">
        <aside class="max-w-lg lg:pr-6 xl:w-1/4 xl:mt-5">
          <h1 class="text-5xl font-bold uppercase leading-none 
                            font-rubik tracking-tighter mb-4 lg:leading-6 lg:mb-6">Syllabi</h1>
          <div class="mb-8">
            {!! get_field('syllabi_blurb') !!}
          </div>
        </aside>
        <div class="max-w-3xl mr-auto grid gap-8 sm:grid-cols-2 lg:grid-cols-3 lg:max-w-full xl:w-3/4 xl:pl-12">
          @if($lpeSyllabi)
            @foreach($lpeSyllabi as $lpeSyllabus)
            <article class="max-w-sm mx-auto flex flex-col justify-between">
              <div class="">
                <header>
                    <h2 class="entry-title my-3">
                    <a href="{{ $lpeSyllabus->url }}" class="text-2xl font-bold uppercase leading-none hover:text-tahini-500 font-rubik tracking-tighter my-3 lg:leading-none lg:text-3xl">
                        {!! $lpeSyllabus->name !!}
                    </a>
                    </h2>
                <span class="font-necto block">{!! $lpeSyllabus->professor !!}</span>
                <span class="font-necto block mb-4">{!! $lpeSyllabus->school !!}</span>

                </header>

              <div class="entry-summary">
                {!! $lpeSyllabus->excerpt !!}
              </div>
            </div>
            <div class="my-3 flex flex-row justify-between" style="max-width: 13rem;">
              @include('components/generic-btn', [ 'url' => $lpeSyllabus->url, 'copy' => 'Learn More' ])
              @include('components/generic-btn', [ 'url' => $lpeSyllabus->download_url, 'copy' => 'Download' ])
            </div>
          </article>
            @endforeach
          @endif
        </div>
      </div>
      <div class="flex max-w-1400">
        <div class="lg:w-1/4"></div>
        <div class="mt-10 mb-6 lg:w-3/4 lg:pl-auto lg:pl-12">
          @include('components/generic-btn', [ 'url' => home_url('/syllabi/'), 'copy' => 'View All Syllabi' ])
        </div>
      </div>
    </section>
    <section class="bg-tahini-500 px-6 py-12 sm:px-8 lg:px-16 xl:px-24">
      <div class="max-w-1400 xl:flex">
        <aside class="max-w-lg lg:pr-6 xl:w-1/4 xl:mt-5">
        <h1 class="text-5xl font-bold uppercase leading-none 
                            font-rubik tracking-tighter mb-4 lg:leading-6 lg:mb-6">Primers</h1>
          <div class="mb-8 primers-blurb">
            {!! get_field('primers_blurb') !!}
          </div>
        </aside>
        <div class="max-w-3xl mr-auto grid gap-8 sm:grid-cols-2 lg:grid-cols-3 lg:max-w-full xl:w-3/4 xl:pl-12">
          @if($primerPosts)
            @foreach($primerPosts as $lpePrimer)
              <article class="max-w-sm mx-auto flex flex-col justify-between">
                <div class="">
                  <header>
                      <h2 class="entry-title my-3">
                      <a href="{!! $lpePrimer->url !!}" class="text-2xl font-bold uppercase leading-none hover:text-white font-rubik tracking-tighter my-3 lg:leading-none lg:text-3xl">
                        {!! $lpePrimer->name !!}
                      </a>
                      </h2>

                  </header>

                <div class="entry-summary">
                  {!! $lpePrimer->excerpt !!}
                </div>
              </div>
              <div class="my-3 flex flex-row justify-between primers-btn" style="max-width: 13rem;">
                @include('components/generic-btn', [ 'url' => $lpePrimer->url, 'copy' => 'Learn More' ])
                @include('components/generic-btn', [ 'url' => $lpePrimer->download_url, 'copy' => 'Download' ])
              </div>
            </article>
            @endforeach
          @endif
        </div>
      </div>
      <div class="flex max-w-1400">
        <div class="lg:w-1/4"></div>
        <div class="primers-nav mt-10 mb-6 lg:w-3/4 lg:pl-auto lg:pl-12">
          @include('components/generic-btn', [ 'url' => home_url('/primers/'), 'copy' => 'View All Primers' ])
        </div>
      </div>
    </section>
  @endwhile
@endsection
