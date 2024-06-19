@if($staticContributors)
<div class="bylines">
        @foreach ($staticContributors as $lpeAuthor)
        <a href="{!! $lpeAuthor->url !!}" rel="author" class="hover:text-tahini-700">
            {!! $lpeAuthor->name !!}</a>@if(!($loop->last)){{ __(',', 'sage') }}@endif
        @endforeach
    </div>
@endif