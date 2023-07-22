<div class="max-w-1400">
    <div class="pb-12 mx-auto xl:flex xl:flex-row xl:p-12 xl:mr-0 xl:pr-0 xl:ml-20">
    <h2 class="p-12 uppercase text-3xl text-white font-bold max-w-xs lg:text-5xl xl:pl-0 ">LPE Masthead</h2>
      
      <div class="px-12 grid md:grid-cols-3 md:gap-6 md:mb-6 xl:mr-0 xl:pr-0 xl:ml-auto">
        <div class="mb-8 md:border-r md:border-white xl:border-l xl:pl-6">
          @if($mastheadMembers->managing)
          <span class="text-white uppercase font-necto block mb-2">Managing Editor</span>
            @foreach($mastheadMembers->managing as $item)
              <a href="{{ $item->url }}" class="font-necto text-white block hover:text-tahini-500 hover:underline">{{ $item->name }}</a>
            @endforeach
          @endif
          @if($mastheadMembers->board)
          <span class="text-white uppercase font-necto block mb-2 mt-8">Editoral Board</span>
            @foreach($mastheadMembers->board as $item)
              <a href="{{ $item->url }}" class="font-necto text-white block hover:text-tahini-500 hover:underline">{{ $item->name }}</a>
            @endforeach
          @endif
          @if($mastheadMembers->students)
          <span class="text-white uppercase font-necto block  mb-2 mt-8">Student Editors</span>
            @foreach($mastheadMembers->students as $item)
              <a href="{{ $item->url }}" class="font-necto text-white block hover:text-tahini-500 hover:underline">{{ $item->name }}</a>
            @endforeach
          @endif
        </div>
        <div class="mb-8 md:border-r md:border-white">
          @if($mastheadMembers->emeriti)
          <span class="text-white uppercase font-necto block mb-2 pr-6">Student Editor Emeriti</span>
            @foreach($mastheadMembers->emeriti as $item)
              <a href="{{ $item->url }}" class="font-necto text-white block hover:text-tahini-500 hover:underline">{{ $item->name }}</a>
              @if($loop->index === $mastheadMembers->emeriti_count)
                </div><div>
              @endif
            @endforeach
          @endif          
        </div>
      </div>
    </div>
</div>