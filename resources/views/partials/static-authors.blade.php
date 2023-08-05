@if($staticContributors)
<div class="">
        <span class="">
        {{ __('By ', 'sage') }}
        </span>
        @foreach ($staticContributors as $lpeAuthor)
        <a href="{!! $lpeAuthor->url !!}" rel="author" class="">
            {{$lpeAuthor->name}}</a>@if(!($loop->last)){{ __(',', 'sage') }}@endif
        @endforeach
    </div>
@endif