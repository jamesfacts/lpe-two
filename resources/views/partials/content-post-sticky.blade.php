
<article @php(post_class('max-w-sm mx-auto md:max-w-md'))>
  @if(@isset($stickyPost->img_url))
    @include('components/thumb-figure', [
      'aspect_ratio' => '65%', 
      'img_url' => $stickyPost->img_url, 
      'url' => $stickyPost->url, 
      'alt' => $stickyPost->image_alt
    ])
  @endif
  <header>
    <h2 class="entry-title">
      <a href="{{ $stickyPost->url }}">
        {!! $stickyPost->title !!}
      </a>
    </h2>

    @if(@isset($stickyPost->authors))
      <div class=" mb-4">
        <span class="by-text  uppercase font-necto leading-tight tracking-wide mb-3">
          {{ __('By ', 'sage') }}
        </span>
        
        @foreach ($stickyPost->authors as $s_contributor)
          <a href="{!! $s_contributor->url !!}" rel="author" class="uppercase font-necto leading-tight tracking-wide mb-3">
            {{$s_contributor->name}}</a>@if(!($loop->last)){{ __(',', 'sage') }}@endif
        @endforeach
      </div>
    @endif
  </header>

  <div class="entry-summary">
    {!! $stickyPost->excerpt !!}
  </div>
</article>
