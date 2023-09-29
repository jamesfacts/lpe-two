{{--
  Template Name: AMRI Overview
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="bg-sunshine-400" >
        <div class="max-w-6xl pl-24 pt-18 pb-16">
            <h1 class="font-tiempos font-bold text-10xl leading-25 tracking-tight">{!! the_title() !!}</h1>
            @if($amri_overview_subhed)
                <span class="font-tiempos text-10xl leading-25 tracking-tight">{{ $amri_overview_subhed }}</span>
            @endif
        </div>
    </div>

    <section class="">
        <div class="flex pt-24 px-20 pb-28">
            <div class="w-1/2 px-4">
                @if($amri_overview_image)
                    <img src="{{ $amri_overview_image->src }}" alt="{{ $amri_overview_image->alt }}">
                @endif
            </div>
            <div class="w-1/2 px-4 font-light text-lg overview-copy">
            @php the_content() @endphp
            </div>
        </div>
    </section>

    <section class="bg-sunshine-400 pt-24 px-20 pb-28">
        <div >
            <h2 class="font-tiempos text-10xl leading-25 tracking-tight mb-20">AMRI Course Overview</h2>
        </div>
        <div class="flex" style="max-width: 1630px;">
            <div class="w-5/12">
                <div class="max-w-sm">
                    <span class="font-rubik font-bold uppercase tracking-tightest">Part 1:</span>
                    <h3 class="font-tiempos text-5xl mb-10">AMRI Foundations</h3>
                    <div class="font-light part-copy">
                        {!! $part_one_copy !!}
                    </div>
                </div>
            </div>
            <div class="w-7/12">
                @if($part_one)
                    <div class="grid grid-cols-2 border-l border-black">
                        @foreach($part_one as $course)
                        <article class="course-item p-10 relative flex flex-col justify-between
                            @if($loop->last)
                                {{ "no-bottom" }}
                            @elseif(($loop->count % 2 === 0) && ($loop->iteration + 1 == $loop->count))
                                {{ "no-bottom" }}
                            @endif
                        ">
                        <div class="text-center">
                            <span class="font-rubik font-bold uppercase tracking-tightest">{{ $course->course_week }}:</span>
                            <h4 class="font-tiempos text-2xl">{!! $course->title !!}</h4>
                            <p class="font-light">Faculty: {!! $course->faculty !!}</p>
                        </div>
                        <div class="flex justify-center mt-5">
                            <a class="border border-black rounded-full uppercase text-xs px-3 text-center py-2 inline-block hover:bg-white" href="{!! $course->url !!}" aria-label="View this AMRI Course">View Course</a>
                        </div>
                        </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    <div class="flex mt-16 border-t border-black pt-12 mb-24" style="max-width: 1630px;">
        <div class="w-5/12">
            <div class="max-w-sm">
                <span class="font-rubik font-bold uppercase tracking-tightest">Part 2:</span>
                <h3 class="font-tiempos text-5xl mb-10">Applications</h3>
                <div class="font-light part-copy">
                    {!! $part_two_copy !!}
                </div>
            </div>
        </div>
        <div class="w-7/12">
            @if($part_two)
                <div class="grid grid-cols-2 border-l border-black">
                    @foreach($part_two as $course)
                    <article class="course-item p-10 relative flex flex-col justify-between
                        @if($loop->last)
                            {{ "no-bottom" }}
                        @elseif(($loop->count % 2 === 0) && ($loop->iteration + 1 == $loop->count))
                            {{ "no-bottom" }}
                        @endif
                    ">
                        <div class="text-center">
                            <span class="font-rubik font-bold uppercase tracking-tightest">{{ $course->course_week }}:</span>
                            <h4 class="font-tiempos text-2xl">{!! $course->title !!}</h4>
                            <p class="font-light">Faculty: {!! $course->faculty !!}</p>
                        </div>
                        <div class="flex justify-center mt-5">
                            <a class="border border-black rounded-full uppercase text-xs px-3 text-center py-2 inline-block hover:bg-white" href="{!! $course->url !!}" aria-label="View this AMRI Course">View Course</a>
                        </div>
                    </article>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    </section>

    <section class="pt-24 px-20 pb-28" style="max-width: 1550px;">
        <div class="pb-10">
            <span class="uppercase font-rubik text-3xl font-bold lg:tracking-tighter">Additional Resources</span>
        </div>
        <div class="flex">
            <div class="w-1/2">
                <div class="max-w-md">
                    <span class="uppercase font-rubik text-2xl font-bold lg:tracking-tight">Organizational Resources:</span>
                    @if($org_copy)
                    <div class="mb-8 font-light text-lg download-copy">
                        {!! $org_copy !!}
                    </div>
                    @endif
                    @include('components/generic-btn', [ 'url' => $reading_pdf, 'copy' => 'Download PDF', 
                        'extra_classes' => 'hover:bg-gray-100 hover:text-black hover:border-black' ])
                </div>
            </div>
            <div class="w-1/2 pl-12 border-l border-black">
                <div class="max-w-md">
                    <span class="uppercase font-rubik text-2xl font-bold lg:tracking-tight">Expanded AMRI Reading List:</span>
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
