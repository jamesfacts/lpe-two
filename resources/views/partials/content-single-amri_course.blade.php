<header style="margin-left: -2px;">
    @if($featuredHeaderImage)
    <span class="block w-full h-full bg-sunshine-400">
        <figure class="h-90" style="background-image: url( '{!! $featuredHeaderImage['url'] !!}' )">
        </figure>
    </span>
    @endif

    <div class="max-w-5xl p-4 m-20">
        <span class="uppercase font-rubik text-xl font-bold lg:tracking-tighter">AMRI Academy</span>
        <h1 class="font-tiempos font-bold text-8xl leading-20 tracking-tight mb-2">{!! get_the_title() !!}</h1>
        <span class="font-tiempos text-8xl leading-20 tracking-tight capitalize">{{ "week " . $this_course_week }}</span>
            @if($faculty_list)
                <span class="faculty block mt-3 text-xl font-thin" style="max-width: 520px;">{!! "Faculty: " . $faculty_list !!}</span>
            @endif
    </div>

</header>

<section class="flex max-w-6xl pr-12">
<div class="w-1/3">

</div>
<article @php post_class('post text-xl font-light w-2/3 pl-8 leading-6 tracking-lil-wide mb-10') @endphp>
    @php the_content() @endphp
</article>

</section>

<section class="mx-0 bg-sand-400 p-20">
    @if(is_object($required_reading))
        <div class="mx-0 max-w-6xl flex border-t border-black pt-6">
            <div class="lg:w-1/4 xl:w-1/3">
                <h2 class="font-tiempos font-medium text-4.5xl leading-10 tracking-tight">Required<br/>Reading</h2>
            </div>
            <div class="px-0 lg:w-3/4 xl:w-2/3 reading-list">
                @foreach($required_reading as $item)
                    @include('partials.amri-reading-item', ['item' => $item])
                @endforeach
            </div>
        </div>
    @endif
</section>

  @if($lecture_oembed)
    <section class="mx-0 bg-sand-400 p-20">
        <div class="mx-0 max-w-6xl flex border-t border-black pt-6">
            <div class="lg:w-1/4 xl:w-1/3">
                <h2 class="font-tiempos font-medium text-4.5xl leading-10 tracking-tight">Recorded<br/>Lecture</h2>
            </div>
            <div class="px-0 lg:w-3/4 xl:w-2/3 relative">
                <div class="embed-container">
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

<section class="mx-0 bg-sand-400 p-20">
    @if($optional_reading)
        <div class="mx-0 max-w-6xl flex border-t border-black pt-6">
            <div class="lg:w-1/4 xl:w-1/3">
                <h2 class="font-tiempos font-medium text-4.5xl leading-10 tracking-tight">Optional<br/>Reading</h2>
            </div>
            <div class="px-0 lg:w-3/4 xl:w-2/3 reading-list">
                @foreach($optional_reading as $item)
                    @include('partials.amri-reading-item', ['item' => $item])
                @endforeach
            </div>
        </div>
    @endif
</section>
