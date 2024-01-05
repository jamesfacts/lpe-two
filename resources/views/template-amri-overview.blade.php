{{--
  Template Name: AMRI Overview
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="bg-sunshine-400" >
        <div class="max-w-6xl pl-6 pr-16 py-10 sm:px-12 lg:pl-24 lg:pt-18 lg:pb-16">
            <h1 class="font-tiempos font-bold text-4xl leading-9 
                        sm:text-5xl sm:tracking-tight sm:leading-11 
                        lg:text-8xl lg:leading-20 lg:tracking-tight
                        xl:text-10xl xl:leading-25 xl:tracking-tight">{!! the_title() !!}</h1>
            @if($amri_overview_subhed)
                <span class="font-tiempos text-4xl leading-9 
                            sm:text-5xl sm:tracking-tight sm:leading-11 
                            lg:text-8xl lg:leading-20 lg:tracking-tight
                            xl:text-10xl xl:leading-25 xl:tracking-tight">{!! $amri_overview_subhed !!}</span>
            @endif
        </div>
    </div>

    <section class="">
        <div class="flex flex-col px-6 py-10 lg:flex-row lg:px-12 lg:pt-16 xl:pt-24 xl:px-20 xl:pb-28">
            <div class="w-full px-4 lg:w-1/2 xl:pl-0">
                @if($amri_overview_image)
                    <img src="{{ $amri_overview_image->src }}" alt="{{ $amri_overview_image->alt }}" class="w-full">
                @endif
            </div>
            <div class="w-full pt-6 max-w-2xl px-4 font-light text-lg overview-copy md:text-base lg:w-1/2 lg:pt-0 xl:text-lg xl:leading-7">
                @php the_content() @endphp
            </div>
        </div>
    </section>

    <section class="bg-sunshine-400 pt-10 px-8 pb-28 lg:px-20 lg:pb-0 xl:pt-24 xl:px-20">
        <div >
            <h2 class="font-tiempos text-4xl leading-9 mb-16 md:text-6xl xl:text-10xl xl:leading-25 xl:tracking-tight xl:mb-20">AMRI Course Overview</h2>
        </div>
        <div class="flex flex-col lg:flex-row" style="max-width: 1630px;">
            <div class="lg:w-1/2 xl:w-5/12">
                <div class="max-w-xl lg:pr-6 xl:max-w-sm">
                    <span class="font-rubik font-bold uppercase tracking-tightest text-lg">Part 1:</span>
                    <h3 class="font-tiempos text-3xl mb-10 lg:text-4xl lg:font-medium xl:text-6xl xl:leading-14">AMRI Foundations</h3>
                    <div class="font-light part-copy pb-12">
                        {!! $part_one_copy !!}
                    </div>
                </div>
            </div>
            <div class="lg:w-1/2 xl:w-7/12">
                @if($part_one)
                    <div class="grid xl:grid-cols-2 xl:border-l xl:border-black">
                        @foreach($part_one as $course)
                        <article class="course-item relative flex flex-col justify-between pb-10 pr-5 mb-10 xl:p-10  xl:mb-0
                            @if($loop->last)
                                {{ 'no-bottom' }}
                            @elseif(($loop->count % 2 === 0) && ($loop->iteration + 1 == $loop->count))
                                {{ 'no-bottom' }}
                            @endif
                        ">
                            <div class="lg:text-center">
                                <span class="font-rubik font-bold uppercase tracking-tightest">{{ $course->course_week }}:</span>
                                <h4 class="font-tiempos text-2xl">{!! $course->title !!}</h4>
                                <p class="font-light">Faculty: {!! $course->faculty !!}</p>
                            </div>
                            <div class="flex mt-5 lg:justify-center">
                                <a class="border border-black rounded-full uppercase text-xs px-3 text-center py-2 inline-block hover:bg-white" href="{!! $course->url !!}" aria-label="View this AMRI Course">View Course</a>
                            </div>
                        </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    <div class="flex flex-col py-6 lg:flex-row lg:border-t lg:border-black lg:mt-16 lg:pt-12 lg:mb-24" style="max-width: 1630px;">
        <div class="lg:w-1/2 xl:w-5/12">
            <div class="max-w-xl lg:pr-6 xl:max-w-sm">
                <span class="font-rubik font-bold uppercase tracking-tightest text-lg">Part 2:</span>
                <h3 class="font-tiempos text-3xl mb-10 lg:text-5xl xl:text-6xl xl:leading-14">Applications</h3>
                <div class="font-light part-copy pb-12">
                    {!! $part_two_copy !!}
                </div>
            </div>
        </div>
        <div class="lg:w-1/2 xl:w-7/12">
            @if($part_two)
                <div class="grid xl:grid-cols-2 xl:border-l xl:border-black">
                    @foreach($part_two as $course)
                    <article class="course-item relative flex flex-col justify-between pb-10 pr-5 mb-10 lg:p-10 
                        @if($loop->last)
                            {{ "no-bottom" }}
                        @elseif(($loop->count % 2 === 0) && ($loop->iteration + 1 == $loop->count))
                            {{ "no-bottom" }}
                        @endif
                    ">
                        <div class="lg:text-center">
                            <span class="font-rubik font-bold uppercase tracking-tightest">{{ $course->course_week }}:</span>
                            <h4 class="font-tiempos text-2xl">{!! $course->title !!}</h4>
                            <p class="font-light">Faculty: {!! $course->faculty !!}</p>
                        </div>
                        <div class="flex mt-5 lg:justify-center">
                            <a class="border border-black rounded-full uppercase text-xs px-3 text-center py-2 inline-block hover:bg-white" href="{!! $course->url !!}" aria-label="View this AMRI Course">View Course</a>
                        </div>
                    </article>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    </section>

    <section class="pt-24 px-8 pb-28 lg:px-20 lg:pt-8" style="max-width: 1550px;">
        <div class="pb-10">
            <span class="uppercase font-rubik text-3xl leading-5 font-bold lg:text-5xl lg:tracking-tighter">Additional Resources</span>
        </div>
        <div class="flex flex-col lg:flex-row">
            <div class="lg:w-1/2 lg:pr-3">
                <div class="max-w-md">
                    <span class="uppercase font-rubik text-2xl font-bold leading-5 block pb-3 lg:tracking-tight">Organizational Resources:</span>
                    @if($org_copy)
                    <div class="mb-8 font-light text-lg download-copy">
                        {!! $org_copy !!}
                    </div>
                    @endif
                    @include('components/generic-btn', [ 'url' => $reading_pdf, 'copy' => 'Download PDF', 
                        'extra_classes' => 'hover:bg-gray-100 hover:text-black hover:border-black' ])
                </div>
            </div>
            <div class="pt-16 lg:pt-0 lg:pl-6 lg:border-l lg:border-black lg:w-1/2 xl:pl-10">
                <div class="max-w-md">
                    <span class="uppercase font-rubik text-2xl font-bold leading-5 block pb-3 pr-10 lg:tracking-tight">Expanded AMRI Reading List:</span>
                    @if($reading_copy)
                    <div class="mb-8 font-light text-lg download-copy">
                        {!! $reading_copy !!}
                    </div>
                    @endif
                    @include('components/generic-btn', [ 'url' => $reading_pdf, 'copy' => 'Download PDF', 
                        'extra_classes' => 'hover:bg-gray-100 hover:text-black hover:border-black' ])
                </div>
            </div>
        </div>
    </section>

  @endwhile
@endsection
