<div class="sidebar w-full">
      @if($twoTierTitle)
        <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-4 lg:text-5xl lg:mt-3 ">
          {!! $twoTierTitle->type !!}
        </h1>
        <h2 class="font-bold uppercase text-2xl lg:text-3xl lg:leading-7 lg:mb-8 lg:ml-6">
          {!! $twoTierTitle->name !!}
        </h2>
      @else
        <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-4 lg:text-5xl lg:mt-3 ">
          {!! $archiveTitle !!}
        </h1>
      @endif
      @if($archiveCopy)
        <div class="archive-copy">
          {!! $archiveCopy !!}
        </div>
      @endif
</div>