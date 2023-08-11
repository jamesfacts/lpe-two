@if($lpeContributors)
  <div class="font-necto max-w-xl lpe-bios">
    @foreach ($lpeContributors as $lpeAuthor)
      {!! $lpeAuthor->excerpt !!}
    @endforeach
  </div>
@endif