<header style="margin-left: -2px;">
    @if($featuredHeaderImage)
    <span class="block w-full h-full bg-sunshine-400">
        <figure class="h-[420px] bg-center bg-no-repeat bg-cover lg:h-[290px]" style="background-image: url( '{!! $featuredHeaderImage['url'] !!}' )">
        </figure>
        
    </span>
    @endif

    <div class="max-w-5xl p-6 sm:p-8 lg:m-20">
        <span class="uppercase font-rubik text-xl font-bold lg:tracking-tighter">AMRI Academy</span>
        <h1 class="font-tiempos font-bold text-4xl leading-8 tracking-tight mb-2 sm:text-4.5xl sm:leading-10 lg:text-6xl lg:leading-16 xl:text-8xl xl:leading-20">{!! get_the_title() !!}</h1>
        <span class="font-tiempos text-4xl leading-8 tracking-tight capitalize lg:text-6xl lg:leading-16 xl:text-8xl xl:leading-20">{{ "week " . $this_course_week }}</span>
            @if($faculty_list)
                <span class="faculty block mt-3 font-thin lg:text-xl" style="max-width: 520px;">{!! "Faculty: " . $faculty_list !!}</span>
            @endif
    </div>

</header>

<section class="flex max-w-6xl pr-2 lg:pr-12">
<div class="lg:w-1/3">

</div>
<div class="text-xl font-light px-6 leading-6 tracking-lil-wide mb-10 max-w-xl sm:px-6 md:px-10 lg:px-0 lg:w-2/3 lg:-ml-6">
    <article @php post_class('post') @endphp>
        @php the_content() @endphp
    </article>
</div>

</section>

<section class="mx-0 bg-sand-400 px-6 pt-16 md:px-10 lg:p-20">
    @if(is_object($required_reading))
        <div class="mx-0 max-w-6xl border-t border-black pt-6 lg:flex">
            <div class="lg:w-1/4 xl:w-1/3">
                <h2 class="font-tiempos font-medium text-4xl leading-8 tracking-tight mb-10 lg:text-4.5xl lg:leading-10">Required<br/>Reading</h2>
            </div>
            <div class="px-0 lg:w-3/4 xl:w-2/3 reading-list pb-12">
                @foreach($required_reading as $item)
                    @include('partials.amri-reading-item', ['item' => $item])
                @endforeach
            </div>
        </div>
    @endif
</section>

  @if($lecture_oembed)
    <section class="mx-0 bg-sand-400 px-6 md:px-10 lg:p-20">
        <div class="mx-0 max-w-6xl pt-6 sm:border-t sm:border-black lg:flex">
            <div class="lg:w-1/4 xl:w-1/3">
                <h2 class="font-tiempos font-medium text-4.5xl leading-10 tracking-tight pb-12 lg:leading-10">Recorded<br/>Lecture</h2>
            </div>
            <div class="px-0 pb-20 lg:w-3/4 xl:w-2/3 relative">
                <div class="video-wrap">
                    {!! $lecture_oembed !!}
                </div>
                @if($lecture_description)
                    <div class="text">
                        {!! $lecture_description !!}
                    </div>
                @endif
            </div>
        </div>
    </section>
  @endif

<section class="mx-0 bg-sand-400 px-6 pb-12 md:px-10 lg:p-20">
    @if($optional_reading)
        <div class="mx-0 max-w-6xl pt-6 sm:border-t sm:border-black lg:flex">
            <div class="lg:w-1/4 xl:w-1/3">
                <h2 class="font-tiempos font-medium text-4.5xl leading-10 tracking-tight lg:leading-10">Optional<br/>Reading</h2>
            </div>
            <div class="px-0 pr-2 lg:w-3/4 xl:w-2/3 reading-list">
                @foreach($optional_reading as $item)
                    @include('partials.amri-reading-item', ['item' => $item])
                @endforeach
            </div>
        </div>
    @endif
</section>
