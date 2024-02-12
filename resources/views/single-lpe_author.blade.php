@extends('layouts.app')

@section('content')

<section class="px-8 lg:flex lg:py-12">
  <aside class="px-5 my-12 sm:w-3/4 sm:ml-0 md:mx-11 lg:max-w-lg lg:mx-0 lg:mt-0 lg:w-1/3 lg:mx-4 lg:w-108">
  
    <h1 class="text-4xl font-bold uppercase leading-none mb-8">{!! get_the_title() !!}</h1>
    @php the_post() @endphp
    @php the_content() @endphp
  </aside>
  <div class="lg:w-2/3">
    <section class="max-w-4xl lg:grid lg:gap-8 lg:grid-cols-2 lg:pl-8 xl:grid-cols-3 xl:mr-auto ">
      @if( $lpeAuthorWork )
        @foreach ( $lpeAuthorWork as $work )
          @include('partials/content-lpe_author', ['work' => $work])
        @endforeach
      @endif
    </section>

    @if($lpeAuthorWorkNav)
    <nav class="navigation posts-navigation" role="navigation" aria-label="Posts navigation" role="navigation">
      <div class="nav-links">
        @if($lpeAuthorWorkNav->previous)
        <div class="nav-previous"><a class="btn" href="{!!$lpeAuthorWorkNav->previous!!}">Previous Work</a></div>
        @endif
        @if($lpeAuthorWorkNav->next)
        <div class="nav-next"><a class="btn" href="{!!$lpeAuthorWorkNav->next!!}">Newer Work</a></div>
        @endif
      </div>
    </nav>
    @endif

  </div>
</section>

<section class="search-wrap bg-beige-200">
  {!! get_search_form(false) !!}
</section>
@endsection