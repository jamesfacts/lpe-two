@php( $split = floor( count($teamMembers) / 2 ) - 1 )

<div class="w-full bg-black relative">
  <div class="bg-black absolute top-0 -left-10 h-full w-20 lg:-left-full" style="width: 200vw;"></div>
  <div class="z-10 relative px-8 py-24 grid justify-items-start lg:-ml-48 lg:gap-10 lg:w-200 lg:grid-cols-3 xl:-ml-80 xl:grid-cols-4 xl:w-300 xl:py-40">
    <h2 class="hidden text-5xl text-white font-rubik font-bold uppercase tracking-tight mt-0 pr-8 xl:block ">Our Team</h2>
      @isset($teamMembers)
        <div class="xl:pl-5 xl:border-l xl:border-white">
        <h2 class="text-4xl text-white font-rubik font-bold uppercase tracking-tight my-6 lg:mt-0 xl:hidden">Our Team</h2>
        @foreach($teamMembers as $member)
          <div class="mb-5">
            <a href="{{ $member->url }}" class="block !text-white font-necto uppercase !no-underline hover:!text-tahini-700">{{ $member->name }}</a>
            <span class="text-white font-necto"> {!! $member->position !!} </span>
          </div>
          @if($loop->index == $split) {!! '</div><div class="split xl:pl-5 xl:border-l xl:border-white">' !!} @endif
        @endforeach
        </div><!-- end split -->
    @endisset

    @isset($studentEditors)
        <div class="xl:pl-5 xl:border-l xl:border-white">
          <span class="block text-white font-necto uppercase pt-6 mb-5 lg:pt-0">Student Editors</span>
          @foreach($studentEditors as $member)
          <div class="">
            <a href="{{ $member->url }}" class="block !text-white font-necto uppercase !no-underline hover:!text-tahini-700">{{ $member->name }}</a>
          </div>
          @endforeach
        </div>
    @endisset
  </div>
</div>