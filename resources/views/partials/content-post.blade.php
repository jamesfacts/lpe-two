
<article @php(post_class('max-w-sm mx-auto md:max-w-md'))>
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

    @if(@isset($loopContributors))
      <div class=" mb-4">
        <span class="by-text  uppercase font-necto leading-tight tracking-wide mb-3">
          {{ __('By ', 'sage') }}
        </span>
        <!-- postContributors -->
        @foreach ($loopContributors as $s_contributor)
          <a href="{!! $contributor->url !!}" rel="author" class="uppercase font-necto leading-tight tracking-wide mb-3">
            {{$s_contributor->name}}</a>@if(!($loop->last)){{ __(',', 'sage') }}@endif
        @endforeach
      </div>
    @else
    <div class="">
      <span class="by-text">
        Sorry, looks like no contributors are set
      </span>
    </div>
    @endif
  </header>

  <div class="entry-summary">
    @php(the_excerpt())
  </div>
</article>