<footer class="bg-black p-6 lpe-footer">
  <div class="max-w-1400 lg:flex xl:pr-16">
      <div class="">
        <h2 class="sr-only">Constellation of LPE Links</h2>
      </div>
      <div class="flex flex-row justify-center pt-12 lg:w-1/2 lg:mr-10 xl:mr-20">
        @include('components/vertical-stack-email')
      </div>
      @if ($footer_navigation)
        <ul class="pt-12 sm:flex sm:flex-wrap sm:flex-col sm:max-h-96 lg:w-1/2 xl:w-2/3 xl:max-h-80">
            @foreach ($footer_navigation as $item)
            <li class="mb-2 lg:w-1/2 xl:w-1/3">
                <a href="{{ $item->url }}" class="uppercase font-necto text-white text-lg pr-5 hover:underline">
                {{ $item->label }}
                </a>

                @if ($item->children)
                <ul class="mb-2">
                    @foreach ($item->children as $child)
                    <li class="leading-none">
                      <a href="{{ $child->url }}" class="uppercase font-necto text-white text-sm pr-5 hover:underline">{{ $child->label }}</a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
      @endif
  </div>
  
  @if ($lower_footer_links)
    <div class="max-w-1400 pt-12 xl:pt-20 xl:pr-16">
        <ul class="md:flex md:flex-row md:justify-center">
            @foreach ($lower_footer_links as $item)
            <li class="md:px-3 lg:px-0">
                <a href="{{ $item->url }}" class="text-white font-necto text-sm hover:underline">
                {{ $item->label }}
                </a>
                @unless($loop->last)
                <span class="text-white px-5 hidden lg:inline">|</span>
                @endunless
            </li>
            @endforeach
        </ul>
    </div>
  @endif
</footer>