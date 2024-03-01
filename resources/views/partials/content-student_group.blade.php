<article @php(post_class('max-w-sm mx-auto px-5 lg:px-0'))>
    @if(@isset($postImage))
        @include('components/thumb-figure', [
        'aspect_ratio' => '65%', 
        'img_url' => $postImage->src, 
        'url' => get_permalink(), 
        'alt' => $postImage->alt
        ])
    @endif

<header>

    <h2 class="entry-title my-3">
      <a href="{{ get_permalink() }}" class="text-2xl font-bold uppercase leading-none hover:text-tahini-500 font-rubik tracking-tighter my-3 lg:leading-none lg:text-3xl">
        {!! $title !!}
      </a>
    </h2>
    <span class="font-necto block mb-4">{!! get_field('school_affiliation') !!}</span>

  </header>

  <div class="entry-summary">
    @php(the_excerpt())
  </div>
</article>
