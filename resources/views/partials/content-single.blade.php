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
              <a href="{!! $lpeAuthor->url !!}" rel="author" class="lpe-contrib black-outline text-4xl font-bold uppercase font-rubik tracking-tight leading-none">
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


<section class="bg-beige-200 px-4 pt-8 pb-24">
<div class="max-w-1400 lg:flex">
  @if( $relatedPosts )
    <div class="font-necto text-center uppercase mb-6 lg:w-1/3 xl:w-1/4">
      <span>Related Content</span>
    </div>
    <div class="lg:w-2/3 xl:w-3/4 xl:grid xl:grid-cols-3 xl:gap-6">
      @foreach( $relatedPosts as $post )
        <article class="w-full max-w-sm mb-8 mx-auto">
          @include('components/thumb-figure',
            ['aspect_ratio' => '65%', 'img_url' => $post->img_url, 'url' => $post->url, 'alt' => $post->alt] )
            <h4 class="mt-4 mb-2">
              <a href="{!! $post->url !!}" class="text-2xl font-bold uppercase tracking-tight leading-none hover:text-tahini-700">{!! $post->title !!}</a>
            </h4>
            @include('partials/static-authors', ['static_post_id' => $post->id])
        </article>
      @endforeach
    </div>
  @endif
  </div>
</section>
