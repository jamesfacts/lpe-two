<article class="mb-5 pb-2 max-w-sm mx-auto">
  <header>
    @if($work->img_url)
        @include('components/thumb-figure', [
          'aspect_ratio' => '65%', 
          'img_url' => $work->img_url, 
          'url' => $work->url, 
          'alt' => $work->alt
        ])
    @elseif(@isset($postImage))
          @include('components/thumb-figure', [
            'aspect_ratio' => '65%', 
            'img_url' => $postImage->src, 
            'url' => get_permalink(), 
            'alt' => $postImage->alt
          ])
    @endif
    <h2 class="text-2xl font-bold uppercase leading-none hover:text-tahini-500 font-rubik tracking-tighter my-3 lg:leading-none lg:text-3xl">
      <a href="{{ get_permalink() }}">
        {!! $work->title ?? $title !!}
      </a>
    </h2>

  </header>
  <div class="entry-summary">
    @if($work->excerpt)
      {!! $work->excerpt !!}
    @else
      @php(the_excerpt())
    @endif
  </div>

</article>
