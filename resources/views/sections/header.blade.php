<header class="nav-wrapper bg-teal-300 py-6 h-[91px] lg:flex lg:h-full lg:space-between" x-data="{ open: false }" :class="open ? 'navigating' : ''">
  <div class="nav-header nav-buttons bg-black z-10 relative lg:flex lg:flex-col lg:px-2 lg:justify-between">
    <button id="menuCollapse" class="absolute lg:relative" type="button" x-on:click=" open = ! open " >
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 30" 
           version="1.1" x="0px" y="0px" class="menu-burger fill-white px-5" style="height:38px;>
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g fill="white">
            <path d="M20.0387825,5.75903332 L4.26253805,5.75903332 C3.7175576,5.75903332 3.2759355,5.31741123 3.2759355,4.7734748 C3.2759355,4.22849435 3.7175576,3.78687226 4.26253805,3.78687226 L20.0387825,3.78687226 C20.5827189,3.78687226 21.024341,4.22849435 21.024341,4.7734748 C21.024341,5.31741123 20.5827189,5.75903332 20.0387825,5.75903332"/>
            <path d="M20.0387825,12.6613882 L4.26253805,12.6613882 C3.7175576,12.6613882 3.2759355,12.2197661 3.2759355,11.6758297 C3.2759355,11.1308493 3.7175576,10.6892272 4.26253805,10.6892272 L20.0387825,10.6892272 C20.5827189,10.6892272 21.024341,11.1308493 21.024341,11.6758297 C21.024341,12.2197661 20.5827189,12.6613882 20.0387825,12.6613882"/>
            <path d="M20.0387825,19.5637431 L4.26253805,19.5637431 C3.7175576,19.5637431 3.2759355,19.1221211 3.2759355,18.5781846 C3.2759355,18.0332042 3.7175576,17.5915821 4.26253805,17.5915821 L20.0387825,17.5915821 C20.5827189,17.5915821 21.024341,18.0332042 21.024341,18.5781846 C21.024341,19.1221211 20.5827189,19.5637431 20.0387825,19.5637431"/>
          </g>
        </g>
      </svg>
      <span class="sr-only">Main Navigation</span>
    </button>
    <a class="brand w-full" href="{{ home_url('/') }}" >
      @include('components.nav-logo')
    </a>
  </div>

  @if (has_nav_menu('primary_navigation'))
    <nav class="nav-primary pt-8 pl-8 bg-black text-white w-full z-5 lg:flex lg:h-full lg:items-center lg:p-0" 
         aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}" :class="open ? 'nav--expanded' : ''" > <!-- bg-yellow-100 -->
      <div class="lg:w-168 lg:mx-auto" aria-modal="true" role="dialog">
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
        {!! get_search_form(false) !!}
      </div>
    </nav>
  @endif

</header>