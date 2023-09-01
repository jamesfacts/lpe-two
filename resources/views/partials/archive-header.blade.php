<div class="sidebar">
      @if($titleTime)
        @dump($titleTime)
      @else
        <h1 class="text-3xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-4 lg:mt-3 lg:text-4xl">
          {!! $archiveTitle !!}
        </h1>
      @endif
      @if($archiveCopy)
        <div class="prose">
          {!! $archiveCopy !!}
        </div>
      @endif
</div>