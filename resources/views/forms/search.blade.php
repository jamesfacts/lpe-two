<form role="search" method="get" class="search-form p-10 md:p-16 lg:max-w-6xl lg:px-32" action="{{ esc_url( home_url( '/' ) ) }}">
    <div class="border-b border-r border-black flex">
      <label class="block" style="max-width: 60%;">
        <span class="screen-reader-text">{{ _x( 'Search for:', 'label' ) }}</span>
        <input type="search" class="search-field bg-transparent font-bold uppercase text-4xl md:text-5xl" placeholder="{!! esc_attr_x( 'Search', 'placeholder' ) !!}" value="{{ get_search_query() }}" name="s" />
      </label>
      <input type="submit" class="search-submit" value="{{ esc_attr_x( '', 'submit button' ) }}" />
    </div>
</form>
  