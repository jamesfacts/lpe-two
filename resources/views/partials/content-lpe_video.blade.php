<article @php(post_class())>
  @if(@isset($postImage))
    @include('components/thumb-figure', [
      'aspect_ratio' => '65%', 
      'img_url' => $postImage->src, 
      'url' => get_field('_youtube_url'), 
      'alt' => $postImage->alt
    ])
  @endif
  <header>  
    <h2 class="my-3">
      <a href="{{ get_field('_youtube_url') }}" class="text-2xl font-bold uppercase leading-none hover:text-tahini-500 
                                                        font-rubik tracking-tighter my-3 lg:leading-6">
        {!! $title !!}
      </a>
    </h2>
  </header>

</article>
