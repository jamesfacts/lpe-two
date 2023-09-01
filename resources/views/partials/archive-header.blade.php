<div class="sidebar">
      @if($twoTierTitle)
       @dump($twoTierTitle)
        <h1 class="text-3xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-4 lg:mt-3 lg:text-4xl">
          {!! $twoTierTitle->type !!}
        </h1>
        <h2>
          {!! $twoTierTitle->name !!}
        </h2>
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