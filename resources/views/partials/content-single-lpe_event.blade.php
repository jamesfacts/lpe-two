<header style="margin-left: -2px;">

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
