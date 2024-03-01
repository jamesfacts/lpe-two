<form role="search" method="get" class="search-form p-10 max-w-xl md:p-16 lg:max-w-6xl lg:px-32" action="{{ esc_url( home_url( '/' ) ) }}">
    <div class="border-b border-r border-black flex">
      <label class="block" style="max-width: 75%;">
        <span class="screen-reader-text">{{ _x( 'Search for:', 'label' ) }}</span>
        <input type="search" class="search-field !bg-transparent font-bold uppercase text-4xl md:text-5xl"
               placeholder="{!! esc_attr_x( 'Search', 'placeholder' ) !!}" value="{{ get_search_query() }}" name="s" />
        
      </label>
      <button type="submit" class="search-submit">
        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 105 89'><path class='st0' d='M52.6 88.6l49.6-44L52.6.6m-50.2 44h99.2' fill='none' stroke-width='2.4'/></svg>
      </button>
    </div>
</form>
  