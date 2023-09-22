{{--
  Template Name: AMRI Overview
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <div class="page-header" style="max-width: 100%;">
        <h1 class="title" style="max-width:1200px;">{!! $title !!}</h1>
        @if($amri_overview_subhed)
            <span class="subhed">{{ $amri_overview_subhed }}</span>
        @endif
    </div>

    <section class="content-contain page-main">
        <div class="row">
            <div class="amri-featured col-lg-5 col-xl-6">
            <img src="{{ $amri_overview_image->src }}" alt="{{ $amri_overview_image->alt }}">
            </div>
            <div class="page-content col-lg-7 col-xl-6">
            @php the_content() @endphp
            </div>
        </div>
    </section>

    <section class="course-grid-contain">
    <div class="row">
        <h2>AMRI Course Overview</h2>
    </div>
    <div class="row part-one" style="max-width: 1630px;">
        <div class="col-lg-6 col-xl-5 px-0 summary-graf">
            <div class="content-wrap">
                <span class="part-eyebrow">Part 1:</span>
                <h3>AMRI Foundations</h3>
                {!! $part_one_copy !!}
            </div>
        </div>
        <div class="col-lg-6 col-xl-7 px-0">
            @if($part_one)
                <div class="course-grid">
                    @foreach($part_one as $course)
                    <article class="course-item
                        @if($loop->last)
                            {{ "no-bottom" }}
                        @elseif(($loop->count % 2 === 0) && ($loop->iteration + 1 == $loop->count))
                            {{ "no-bottom" }}
                        @endif
                    ">
                    <div class="">
                        <span class="eyebrow">{{ $course->course_week }}:</span>
                        <h4>{!! $course->title !!}</h4>
                        <p class="faculty">Faculty: {!! $course->faculty !!}</p>
                    </div>
                        <a class="read-more-btn btn" href="{!! $course->url !!}" aria-label="View this AMRI Course">View Course</a>
                    </article>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div class="row part-two" style="max-width: 1630px;">
        <div class="col-lg-6 col-xl-5 px-0 summary-graf">
            <div class="content-wrap">
                <span class="part-eyebrow">Part 2:</span>
                <h3>Applications</h3>
                {!! $part_two_copy !!}
            </div>
        </div>
        <div class="col-lg-6 col-xl-7 px-0">
            @if($part_two)
                <div class="course-grid">
                    @foreach($part_two as $course)
                    <article class="course-item
                        @if($loop->last)
                            {{ "no-bottom" }}
                        @elseif(($loop->count % 2 === 0) && ($loop->iteration + 1 == $loop->count))
                            {{ "no-bottom" }}
                        @endif
                    ">
                    <div class="">
                        <span class="eyebrow">{{ $course->course_week }}:</span>
                        <h4>{!! $course->title !!}</h4>
                        <p class="faculty">Faculty: {!! $course->faculty !!}</p>
                    </div>
                        <a class="read-more-btn btn" href="{!! $course->url !!}" aria-label="View this AMRI Course">View Course</a>
                    </article>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    </section>

    <section class="additional-resources" style="max-width: 1550px;">
        <div class="row">
            <span class="resource-hed">Additional Resources</span>
        </div>
        <div class="row">
            <div class="col-md-6 px-0">
                <div class="resource-item">
                    <span class="resource-item-hed">Organizational Resources:</span>
                    @if($org_copy)
                    <div class="">
                        {!! $org_copy !!}
                    </div>
                    @endif
                    <a href="{!! $org_pdf !!}" class="read-more-btn btn">
                        Download PDF
                    </a>
                </div>
            </div>
            <div class="col-md-6 px-0">
                <div class="resource-item">
                    <span class="resource-item-hed">Expanded AMRI Reading List:</span>
                    @if($reading_copy)
                    <div class="">
                        {!! $reading_copy !!}
                    </div>
                    @endif
                    <a href="{!! $reading_pdf !!}" class="read-more-btn btn">
                        Download PDF
                    </a>
                </div>
            </div>
        </div>
    </section>

  @endwhile
@endsection
