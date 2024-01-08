
<article @php(post_class('max-w-sm mx-auto md:max-w-md pb-8'))>
  @if(@isset($stickyPost->img_url))
    @include('components/thumb-figure', [
      'aspect_ratio' => '65%', 
      'img_url' => $stickyPost->img_url, 
      'url' => $stickyPost->url, 
      'alt' => $stickyPost->image_alt
    ])
  @endif
  <header>
    <h2 class="text-3xl font-bold uppercase font-rubik tracking-tighter leading-none my-3 lg:leading-6 lg:text-2xl xl:leading-8 xl:text-3xl">
      <a href="{{ $stickyPost->url }}" class="hover:text-tahini-500">
        {!! $stickyPost->title !!}
      </a>
    </h2>

    @if(@isset($stickyPost->authors))
      <div class=" mb-4">
        <span class="by-text  uppercase font-necto leading-tight tracking-wide mb-3">
          {{ __('By ', 'sage') }}
        </span>
        
        @foreach ($stickyPost->authors as $s_contributor)
          <a href="{!! $s_contributor->url !!}" rel="author" class="uppercase font-necto leading-tight tracking-wide mb-3 hover:underline">
            {{$s_contributor->name}}</a>@if(!($loop->last)){{ __(',', 'sage') }}@endif
        @endforeach
      </div>
    @endif
  </header>

  <div class="entry-summary">
    {!! $stickyPost->excerpt !!}
  </div>
</article>
