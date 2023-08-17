<article @php(post_class('max-w-sm mx-auto px-5 lg:px-0'))>
    <header>
        <h2 class="entry-title my-3">
        <a href="{{ get_permalink() }}" class="text-2xl font-bold uppercase leading-none hover:text-tahini-500 font-rubik tracking-tighter my-3 lg:leading-none lg:text-3xl">
            {!! $title !!}
        </a>
        </h2>
    <span class="font-necto block">{!! $loopSyllabi->professor !!}</span>
    <span class="font-necto block mb-4">{!! $loopSyllabi->school !!}</span>

    </header>

  <div class="entry-summary">
    @php(the_excerpt())
  </div>
  <div class="my-3 flex flex-row justify-between" style="max-width: 13rem;">
    @include('components/generic-btn', [ 'url' => $loopSyllabi->url, 'copy' => 'Learn More' ])
    @include('components/generic-btn', [ 'url' => $loopSyllabi->download_url, 'copy' => 'Download' ])
  </div>
</article>
