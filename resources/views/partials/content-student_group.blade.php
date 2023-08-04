<article @php(post_class())>
    @if(@isset($postImage))
        @include('components/thumb-figure', [
        'aspect_ratio' => '65%', 
        'img_url' => $postImage->src, 
        'url' => get_permalink(), 
        'alt' => $postImage->alt
        ])
    @endif

<header>

    <h2 class="entry-title">
      <a href="{{ get_permalink() }}">
        {!! $title !!}
      </a>
    </h2>

    howdy. i'm the sheriff of student groups

  </header>

  <div class="entry-summary">
    @php(the_excerpt())
  </div>
</article>
