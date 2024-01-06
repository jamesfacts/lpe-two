<div class="sidebar">
      @if($twoTierTitle)
       @dump($twoTierTitle)
        <h1 class="text-3xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-4 lg:mt-3 xl:text-4xl">
          {!! $twoTierTitle->type !!}
        </h1>
        <h2>
          {!! $twoTierTitle->name !!}
        </h2>
      @else
        <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-4 lg:mt-3 xl:text-5xl">
          {!! $archiveTitle !!}
        </h1>
      @endif
      @if($archiveCopy)
        <div class="">
          {!! $archiveCopy !!}
        </div>
      @endif
</div>