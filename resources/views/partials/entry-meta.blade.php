
@if(@isset($loopContributors))
  <div class="">
    <span class="by-text font-bold uppercase font-rubik leading-tight tracking-wide mb-3">
      {{ __('By ', 'sage') }}
    </span>
    <!-- postContributors -->
    @foreach ($loopContributors as $s_contributor)
      <a href="{!! $contributor->url !!}" rel="author" class="font-bold uppercase font-rubik leading-tight tracking-wide mb-3">
        {{$s_contributor->name}}</a>@if(!($loop->last)){{ __(',', 'sage') }}@endif
    @endforeach
  </div>
@else
<div class="">
  <span class="by-text">
    Sorry, looks like no contributors are set
  </span>
</div>
@endif