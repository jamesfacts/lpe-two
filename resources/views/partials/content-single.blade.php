<header style="margin-left: -2px;">
  @if($featuredHeaderImage)
    <span class="block w-full h-full" style="background-color: #d5f0e5;">
        <figure class="h-80" style="background-image: url( '{!! $featuredHeaderImage['url'] !!}' )">
        </figure>
    </span>
  @endif

  <div class="mx-4 lg:mx-8 max-w-xl">
    @if($conference_symposia)
      <span class="">
        <a href="{{ home_url('/symposia/') . $conference_symposia->slug }}">{!! $conference_symposia->name !!}</a>
      </span>
    @endif

    <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-1">{!! get_the_title() !!}</h1>
    @if($lpeContributors)
        <div class="">
            @foreach ($lpeContributors as $lpeAuthor)
            <a href="{!! $lpeAuthor->link !!}" rel="author" class="lpe-contrib black-outline text-4xl font-bold uppercase font-rubik tracking-tight leading-none">
                {{$lpeAuthor->name}}</a>@if(!($loop->last)){{ __(',', 'sage') }}@endif
            @endforeach
        </div>
    @endif
    <div class="mt-2 lg:hidden">
      @include('components.time-updated')
    </div>
  </div>

</header>

<section class="mx-4 flex flex-col-reverse mb-32 lg:flex-row">
  <div class="lg:mt-12 lg:ml-4 lg:mr-16 lg:flex lg:flex-col lg:justify-between">
    <div class="hidden lg:block">
      @include('partials.entry-author-bio')
      <span class="py-3 lg:block"></span>
      @include('components.time-updated')
    </div>
    <div class="">
      @include('components.share', ['parent_view' => 'Single'])
      <span class="py-2 block"></span>
      @include('partials.entry-author-bio')
    </div>
  </div>
  <article @php post_class('mt-8 prose') @endphp>
    <div class="">
      @php the_content() @endphp
    </div>
    <div class="my-10">
        <a class="generic-button no-underline" href="{{home_url('/blog/')}}" aria-label="View All Blog Posts">
            Back to the Blog Homepage
        </a>
    </div>
  </article>

</section>


<section class="">

  @if( $relatedPosts )
    <div class="hed">
      <span>Related Content</span>
    </div>

    <div class="read-more-container">
      @foreach( $relatedPosts as $post )
        <article class="read-more-single col-12 col-lg-4">
          @include('components/thumb-figure',
            ['aspect_ratio' => '56.25%', 'img_url' => $post->img_url, 'url' => $post->url, 'alt' => $post->alt] )
          <div class="story-meta">
            <h4 class="related-story-hed">
              <a href="{!! $post->url !!}">{!! $post->title !!}</a>
            </h4>
            @include('partials/entry-authors', ['post_id' => $post->id])
          </div>
        </article>
      @endforeach
    </div>
  @endif

  @if( $related_symposia_posts && count($related_symposia_posts) >= 1)
    <span class="">Blog Symposia</span>
    @if($conference_symposia->name && $conference_symposia->count >= 2 )
      <span class="">{{$conference_symposia->name}}</span>
    @endif

    <div class="">
      @foreach( $related_symposia_posts as $post )
        <article class="">
          @include('components/thumb-figure',
            ['aspect_ratio' => '56.25%', 'img_url' => $post->img_url, 'url' => $post->url] )
          <div class="">
            <h4 class="">
              <a href="{!! $post->url !!}">{!! $post->title !!}</a>
            </h4>
            @include('partials/entry-authors', ['post_id' => $post->id])
            <a href="{!! $post->url !!}" class="px-3 py-2" aria-label="Continue to Full Story">
              <span>Read More</span>
              <svg width="22" height="16" viewBox="0 0 28 21" aria-hidden="true" tabindex="0" class="pl-1">
                <path d="M12 0.5L26.5 10M26.5 10L12 20M26.5 10H0" stroke="currentColor"/>
              </svg>
            </a>
          </div>
        </article>
      @endforeach
    </div>

  @endif
</section>
