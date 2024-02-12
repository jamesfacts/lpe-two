<header style="margin-left: -2px;" class="@if($conference_symposia){{'conf-symposia'}}@endif">
  @if($featuredHeaderImage)
    <span class="decorative-img block w-full h-full" style="@if(!($conference_symposia)){{'background-color: #d5f0e5;'}}@endif ">
        <figure class="h-80 xl:bg-cover" style="background-image: url( '{!! $featuredHeaderImage['url'] !!}' )">
        </figure>
    </span>
  @endif

  <div class="header-text px-4 max-w-xl text-xl sm:px-8 md:px-16 md:pt-12 lg:mx-0 lg:pl-20 lg:max-w-3xl xl:pb-16 xl:pt-20">
    @if($conference_symposia)
      <span class="uppercase font-bold block mt-8">
        <a href="{{ home_url('/symposia/') . $conference_symposia->slug }}" class=" hover:underline">{!! $conference_symposia->name !!}</a>
      </span>
    @endif

    <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-1 lg:text-4.5xl lg:leading-10 lg:tracking-lil-tight">{!! get_the_title() !!}</h1>
    @if($lpeContributors)
        <div class="contrib-meta text-4xl font-bold mt-2">
            @foreach ($lpeContributors as $lpeAuthor)
              <a href="{!! $lpeAuthor->url !!}" rel="author" class="lpe-contrib black-outline text-4xl font-bold uppercase font-rubik tracking-lil-tight leading-none lg:text-4.5xl lg:leading-10 lg:tracking-tight">
                {{$lpeAuthor->name}}</a>@if(!($loop->last)){{ __(',', 'sage') }}@endif
            @endforeach
        </div>
    @endif
    <div class="timestamp mt-2 lg:hidden">
      @include('components.time-updated')
    </div>
  </div>

</header>

<section class="px-4 flex flex-col-reverse pb-32 @if($conference_symposia){{'conf-symposia'}}@endif lg:flex-row lg:pl-16 lg:pr-14 xl:pl-8">
  <div class="lg:mt-8 lg:mx-4 lg:flex lg:flex-col lg:justify-between lg:w-[220px] xl:max-w-sm xl:pr-0 xl:mr-0 xl:pl-8 xl:w-[250px]">
    <div class="hidden lg:block">
      @include('partials.entry-author-bio')
      <span class="py-3 lg:block"></span>
      @include('components.time-updated')
    </div>
    <div class="px-4 sm:pl-8 md:pl-16 lg:pr-0">
      @include('components.share', ['parent_view' => 'Single'])
      <span class="py-2 block"></span>
      @include('partials.entry-author-bio')
    </div>
  </div>
  <article @php post_class('mt-8 max-w-2xl lg:pl-2 xl:pl-8') @endphp>
    <div class="px-4 sm:pl-8 md:pl-16 lg:pl-24 lg:pr-3 xl:pl-16">
      @php the_content() @endphp
    </div>
    <div class="my-10 px-4 sm:pl-8 md:pl-16 lg:pl-12">
        <a class="generic-button !no-underline !text-black hover:!text-tahini-500" href="{{home_url('/blog/')}}" aria-label="View All Blog Posts">
            Back to the Blog Homepage
        </a>
    </div>
  </article>

</section>

<section class="bg-beige-200 px-6 pt-8 pb-24">
<div class="max-w-1400 @if($conference_symposia){{'conf-related'}}@endif lg:px-16 lg:flex xl:px-20">
  @if( $relatedPosts )
  <div class="related-hed mb-6 lg:w-1/3 xl:w-1/4">
  @if($conference_symposia)
      <span class="block font-tiempos text-3xl font-bold">Blog Symposia</span>
      <span class="block font-tiempos text-3xl capitalize mb-8">{!! $conference_symposia->name !!}</span>
    @else
      <span class="font-necto text-center uppercase">Related Content</span>
    @endif
  </div>

    <div class="related-items lg:w-2/3 xl:w-3/4 xl:grid xl:grid-cols-3 xl:gap-6">
      @foreach( $relatedPosts as $post )
        <article class="w-full max-w-sm mb-8  mx-auto">
          @include('components/thumb-figure',
            ['aspect_ratio' => '65%', 'img_url' => $post->img_url, 'url' => $post->url, 'alt' => $post->alt] )
            <h4 class="mt-4 mb-2 text-2xl font-bold uppercase tracking-tight leading-none">
              <a href="{!! $post->url !!}" class=" hover:text-tahini-700">{!! $post->title !!}</a>
            </h4>
            @include('partials/static-authors', ['static_post_id' => $post->id])

            @if($conference_symposia)
              <a href="{!! $post->url !!}" class="px-3 py-2 read-more-btn flex border-black border w-36 justify-center items-center hover:text-tahini-700 hover:border-tahini-700 block mt-4 mb-12" aria-label="Continue to Full Story">
                <span class="pr-3">Read More</span>
                <svg width="22" height="16" viewBox="0 0 28 21" aria-hidden="true" tabindex="0" class="pl-1">
                  <path d="M12 0.5L26.5 10M26.5 10L12 20M26.5 10H0" stroke="currentColor"></path>
                </svg>
              </a>
            @endif
        </article>
      @endforeach
    </div>
  @endif
  </div>
</section>
