{{--
  Template Name: Engage Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <section class="engage-header mx-6 py-12 border-b border-black sm:px-8 lg:px-16 xl:px-24">
      <div class="max-w-1400 md:flex lg:mt-12">
        <aside class="mb-8 md:mr-12 lg:mr-auto lg:w-1/3">
        <h1 class="text-5xl font-bold uppercase leading-none
                            font-rubik tracking-tighter mb-10 lg:mb-16 xl:text-6xl">{!! the_title() !!}</h1>
          @if (has_nav_menu('engage_navigation'))
            {!! wp_nav_menu(['theme_location' => 'engage_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
          @endif
        </aside>
        <div class="md:px-6 lg:w-2/3 lg:pl-0 lg:ml-12 lg:mt-2">
          <div class="max-w-xl">@php(the_content())</div>
        </div>
      </div>
    </section>
    <section class="mx-6 py-12 border-b border-black sm:px-8 lg:px-16 xl:px-24">
      @if($lpeStudentGroups)
      <div class="max-w-1400">
        <aside class="">
        <h1 class="text-4xl font-bold uppercase leading-none 
                            font-rubik tracking-tighter mb-10 lg:leading-8 lg:mb-16">Student<br/>Groups</h1>
        </aside>
        <div class="max-w-3xl grid gap-8 sm:grid-cols-2 lg:grid-cols-3 lg:max-w-6xl">
          @foreach($lpeStudentGroups as $group)
          <article class="w-full bg-teal-200 max-w-sm mx-auto px-5 lg:px-0">
            @if(@isset($group->img_url))
                @include('components/thumb-figure', [
                'aspect_ratio' => '65%', 
                'img_url' => $group->img_url, 
                'url' => $group->url, 
                'alt' => $group->alt
                ])
            @endif

          <header>
            <h2 class="entry-title my-3">
              <a href="{{ get_permalink() }}" class="text-2xl font-bold uppercase leading-none hover:text-tahini-500 font-rubik tracking-tighter my-3 lg:leading-none lg:text-3xl">
                {!! $group->name !!}
              </a>
            </h2>
            <span class="font-necto block mb-4">{!! $group->school !!}</span>

          </header>
        </article>

          @endforeach
        </div>
      </div>
      <div class="flex max-w-1400">
        <div class=""></div>
        <div class="mt-10 mb-6">
          @include('components/generic-btn', [ 'url' => home_url('/student-groups/'), 'copy' => 'View All Student Groups' ])
        </div>
      </div>
      @endif
    </section>
    <section class="px-6 py-12 sm:px-8 lg:px-16 xl:px-24">
      <div class="max-w-1400 xl:flex">
        <aside class="max-w-sm xl:w-1/4">
          <h1 class="text-4xl font-bold uppercase leading-none 
                            font-rubik tracking-tighter mb-10 lg:leading-8 lg:mb-16">Start a Student<br/>Group</h1>
        </aside>
        <div class="speakers-blurb mb-8 max-w-5xl xl:w-3/4 xl:pl-12">
          {!! get_field('student_groups_blurb') !!}
          <div class="block my-2">&nbsp;</div>
          @include('components/generic-btn', [ 'url' => get_field('student_group_form'), 'copy' => 'Go To Form' ])
        </div>
      
      </div>
    </section>
    <section class="bg-tahini-500 px-6 py-12 sm:px-8 lg:px-16 xl:px-24">
      <div class="max-w-1400 xl:flex">
        <aside class="max-w-lg lg:pr-6 xl:w-1/4 xl:mt-3">
          <h1 class="text-4xl font-bold uppercase leading-none 
                            font-rubik tracking-tighter mb-4 lg:leading-8 lg:mb-6">Speakers<br/>Bureau</h1>
          <div class="mb-8">
            {!! get_field('speakers_blurb') !!}
          </div>
          @if($lpeSpeakerTopics)
            @include('components/speakers-tax', ['topics' => $lpeSpeakerTopics])
          @endif

        </aside>
        <div class="max-w-3xl mr-auto grid gap-8 sm:grid-cols-2 lg:grid-cols-3 lg:max-w-full xl:w-3/4 xl:pl-12">
          @if($lpeSpeakers)
            @foreach($lpeSpeakers as $lpeSpeaker)
              <article class="border-b border-black mb-5 pb-2">
                <header>
                  <h2 class="text-2xl font-bold uppercase leading-none font-rubik tracking-tighter my-3 lg:leading-none lg:text-3xl">
                    <a href="{{ $lpeSpeaker->url }}">
                      {!! $lpeSpeaker->name !!}
                    </a>
                  </h2>

                  <span class="font-necto block mb-6">{!! $lpeSpeaker->home_base !!}</span>
                </header>
              </article>
            @endforeach
          @endif
        </div>
      </div>
      <div class="flex max-w-1400">
        <div class="lg:w-1/4"></div>
        <div class="speakers-nav mt-10 mb-6 lg:w-3/4 lg:pl-auto lg:pl-12">
          @include('components/generic-btn', [ 'url' => home_url('/speakers/'), 'copy' => 'View All Speakers' ])
        </div>
      </div>
    </section>
  @endwhile
@endsection
