@if($lpeContributors)
  <div class="font-necto max-w-xl">
    @foreach ($lpeContributors as $lpeAuthor)
      {!! $lpeAuthor->excerpt !!}
    @endforeach
  </div>
@endif