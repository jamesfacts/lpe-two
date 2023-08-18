<article @php(post_class())>
  @if(@isset($work->img_url))
    @include('components/thumb-figure', [
      'aspect_ratio' => '65%', 
      'img_url' => $work->img_url, 
      'url' => $work->url, 
      'alt' => $work->image_alt
    ])
  @endif
  <header>
    
    <h2 class="">
      <a href="{{ $work->url }}">
        {!! $work->title !!}
      </a>
    </h2>

  </header>

  <div class="entry-summary">
    {{ $work->excerpt }}
  </div>
</article>
