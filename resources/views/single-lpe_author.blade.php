@extends('layouts.app')

@section('content')

<section>
  @if( have_posts() ) @php(the_post() )
  <h1>{!! get_the_title() !!}</h1>
    @php( the_content() )

    @if($contributorWork)
    <div>
        @foreach($contributorWork as $post)
          @includeFirst(['partials.content-single-' . get_post_type(), 'partials.content-single'])
        @endforeach
    </div>
    @endif
  @endif
</section>

<section>
  {!! get_search_form(false) !!}
</section>
@endsection
