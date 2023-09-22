<header style="margin-left: -2px;">
    @if($featuredHeaderImage)
    <span class="block w-full h-full bg-sunshine-400">
        <figure class="h-100" style="background-image: url( '{!! $featuredHeaderImage['url'] !!}' )">
        </figure>
    </span>
    @endif

    <div class="max-w-3xl p-20">
        <span class="uppercase font-rubik text-xl font-bold lg:tracking-tighter">AMRI Academy</span>
        <h1 class="font-tiempos font-bold text-6xl">{!! get_the_title() !!}</h1>
        <span class="font-tiempos text-6xl capitalize">{{ "week " . $this_course_week }}</span>
            @if($faculty_list)
                <span class="faculty" style="max-width: 520px;">{!! "Faculty: " . $faculty_list !!}</span>
            @endif
    </div>

</header>

  <section class="row mx-0" style="max-width: 1280px;">
    <div class="col-lg-3 col-xl-4">

    </div>
    <article @php post_class('post col-lg-8') @endphp>
      <div class="entry-content">
        @php the_content() @endphp
      </div>
    </article>

  </section>

  <section class="mx-0 reading-section">
    @if(is_object($required_reading))
    <div class="row mx-0 reading-row" style="max-width: 1150px;">
        <div class="px-0 col-12 col-lg-3 col-xl-4">
            <h2>Required<br/>Reading</h2>
        </div>
        <div class="px-0 col-12 col-lg-9 col-xl-8 reading-list">
            @foreach($required_reading as $item)
               @include('partials.amri-reading-item', ['item' => $item])
            @endforeach
        </div>
    </div>
    @endif
  </section>

  @if(strlen($lecture_oembed) > 0)
    <section class="mx-0 reading-section lecture">
        <div class="row mx-0 reading-row" style="max-width: 1150px;">
            <div class="px-0 col-12 col-lg-3 col-xl-4">
                <h2>Recorded<br/>Lecture</h2>
            </div>
            <div class="px-0 col-12 col-lg-9 col-xl-8 reading-list">
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

  <section class="mx-0 reading-section">
    @if(is_object($optional_reading))
    <div class="row mx-0 reading-row" style="max-width: 1150px;">
        <div class="px-0 col-12 col-lg-3 col-xl-4">
            <h2>Optional<br/>Reading</h2>
        </div>
        <div class="px-0 col-12 col-lg-9 col-xl-8 reading-list">
            @foreach($optional_reading as $item)
               @include('partials.amri-reading-item', ['item' => $item])
            @endforeach
        </div>
    </div>
    @endif
  </section>
