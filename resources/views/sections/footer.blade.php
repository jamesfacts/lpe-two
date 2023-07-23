<footer class="bg-black p-6 lpe-footer">
  <div class="max-w-1400">
      <div class="">
        <h2 class="sr-only">Constellation of LPE Links</h2>
      </div>
      <div class="col-12 col-lg-5 newsletter-footer">
        @include('components/vertical-stack-email')
      </div>
      @if ($footer_navigation)
        <ul class="max-w-1400 flex flex-wrap flex-col" style="max-height:350px">
            @foreach ($footer_navigation as $item)
            <li class="bg-gray-700 mb-2">
                <a href="{{ $item->url }}" class="uppercase font-necto text-white text-lg hover:underline">
                {{ $item->label }}
                </a>

                @if ($item->children)
                <ul class="mb-2">
                    @foreach ($item->children as $child)
                    <li class="leading-none">
                      <a href="{{ $child->url }}" class="uppercase font-necto text-white text-sm hover:underline">{{ $child->label }}</a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
      @endif
  </div>
  
  <div class="max-w-1400">
  </div>
  @if ($lower_footer_links)
    <div class="max-w-1400">
        <ul class="md:flex md:flex-row md:justify-center">
            @foreach ($lower_footer_links as $item)
            <li class="px-3 lg:px-0">
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