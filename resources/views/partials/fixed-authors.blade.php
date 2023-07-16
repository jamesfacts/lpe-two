@php
/**
 * Partial for use when we're in a loop page, and we can't use `get_the_ID` to
 * determine our authors' info. Putting this in a partial so we can use
 * Laravel helper functions
 */

$contributorsInArticle = get_field('_author', $featured_id);

if(is_array($contributorsInArticle)) {
    foreach ($contributorsInArticle as $contributorID) {
        $contributors[] = (object)[
            'name' => get_the_title($contributorID),
            'url' => get_permalink($contributorID),
        ];
    }
}

@endphp

@if ($contributors)
  <div class="author-wrap mb-4">
    <span class="by-text text-3xl font-bold uppercase font-rubik leading-tight tracking-wide mb-3">
      {{ __('By ', 'sage') }}
    </span>
    @foreach ($contributors as $contributor)
      <a href="{!! $contributor->url !!}" rel="author" class="text-3xl font-bold uppercase font-rubik leading-tight tracking-wide mb-3">
        {{$contributor->name}}</a>@if(!($loop->last)){{ __(',', 'sage') }}@endif
    @endforeach
  </div>
@else
<div class="author-wrap">
  <span class="by-text">
    Sorry, looks like no contributors are set
  </span>
</div>
@endif