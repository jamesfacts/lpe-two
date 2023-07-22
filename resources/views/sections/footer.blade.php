<footer class="bg-black p-6">
<!--  site-footer -->
  <div class="max-w-1400">
      <div class="">
        <h2 class="sr-only">Constellation of LPE Links</h2>
      </div>
      <div class="col-12 col-lg-5 newsletter-footer">
        @include('components/vertical-stack-email')
      </div>
      <div class="col-12 col-lg-7 contain-footer-menus">
        @php dynamic_sidebar('sidebar-footer') @endphp
      </div>
  </div>
  
  <div class="max-w-1400">
  </div>
  @if ($lower_footer_links)
    <div class="max-w-1400">
        <ul class="">
            @foreach ($lower_footer_links as $item)
            <li class="" >
                <a href="{{ $item->url }}" class="text-white">
                {{ $item->label }}
                </a>

                @if ($item->children)
                <ul class="" >
                    @foreach ($item->children as $child)
                    <li class="">
                        <a href="{{ $child->url }}" class="text-white">
                        {{ $child->label }}
                        </a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
  </div>
@endif
</footer>