@extends('layouts.app')

@section('content')

<section class="row blog-wrap mr-0 ml-0">
  <div class="col-12 col-lg-4 {{ ($lpe_author_work) ? '' : 'offset-author-sidebar' }} sidebar">
    <h1 class="single-author-hed">{!! get_the_title() !!}</h1>
    @php the_post() @endphp
    @php the_content() @endphp
  </div>
  <div class="col-12 col-lg-8 blog-feed">
    <section class="row">
      @if( $lpe_author_work )
        @foreach ( $lpe_author_work as $work )
          @include('partials/content-author', ['work' => $work])
        @endforeach
      @endif
    </section>
    @dump($lpe_author_work)
    @if($lpe_author_work_nav)
    <nav class="navigation posts-navigation" role="navigation" aria-label="Posts navigation" role="navigation">
      <div class="nav-links">
        @if($lpe_author_work_nav->previous)
        <div class="nav-previous"><a class="btn" href="{!!$lpe_author_work_nav->previous!!}">Previous Work</a></div>
        @endif
        @if($lpe_author_work_nav->next)
        <div class="nav-next"><a class="btn" href="{!!$lpe_author_work_nav->next!!}">Newer Work</a></div>
        @endif
      </div>
    </nav>
    @endif

  </div>
</section>

<section class="row search-wrap">
  {!! get_search_form(false) !!}
</section>
@endsection