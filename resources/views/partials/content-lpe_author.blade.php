<article class="mb-5 pb-2 max-w-sm mx-auto single-lai">
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
            'url' => $work->url, 
            'alt' => $postImage->alt
          ])
    @endif
    <h2 class="text-2xl font-bold uppercase leading-none hover:text-tahini-500 font-rubik tracking-tighter my-3 lg:leading-none lg:text-3xl xl:leading-6 xl:text-2xl">
      <a href="{{ $work->url ?? get_the_permalink() }}">
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