@if($lpeContributors)
    <div class="">
        <span class="">
        {{ __('By ', 'sage') }}
        </span>
        @foreach ($lpeContributors as $lpeAuthor)
        <a href="{!! $lpeAuthor->link !!}" rel="author" class="">
            {{$lpeAuthor->name}}</a>@if(!($loop->last)){{ __(',', 'sage') }}@endif
        @endforeach
    </div>
@endif