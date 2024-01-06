
<article @php(post_class('max-w-sm mx-auto md:max-w-md'))>
  @if(@isset($postImage))
    @include('components/thumb-figure', [
      'aspect_ratio' => '65%', 
      'img_url' => $postImage->src, 
      'url' => get_permalink(), 
      'alt' => $postImage->alt
    ])
  @endif

  <div class="uppercase font-necto mt-2">
    @if($postCategories)
      @foreach ($postCategories as $lpe_category)
        <a href="{!! $lpe_category->link !!}" class="">
          {!! $lpe_category->name !!}</a>@if(!($loop->last)){{ __(',', 'sage') }}@endif
      @endforeach
    @else
      {{ __('LPE Originals', 'sage') }}
    @endif
  </div>

  <header>
    <h2 class="text-3xl font-bold uppercase font-rubik tracking-tighter leading-none my-3 lg:text-2xl xl:text-3xl">
      <a href="{{ get_permalink() }}" class="hover:text-tahini-500">
        {!! $title !!}
      </a>
    </h2>

    @if(@isset($loopContributors))
      <div class=" mb-4">
        <span class="by-text  uppercase font-necto leading-tight tracking-wide mb-3">
          {{ __('By ', 'sage') }}
        </span>
        
        @if(count($loopContributors) == 0 )
            <a href="javascript:void(0)" class="uppercase font-necto leading-tight tracking-wide mb-3 ">LPE Editors</a>
        @endif
        @foreach ($loopContributors as $s_contributor)
          <a href="{!! $s_contributor->url !!}" rel="author" class="uppercase font-necto leading-tight tracking-wide mb-3 hover:text-tahini-500">
            {{$s_contributor->name}}</a>@if(!($loop->last)){{ __(',', 'sage') }}@endif
        @endforeach
      </div>
    @endif
  </header>

  <div class="entry-summary">
    @php(the_excerpt())
  </div>
</article>