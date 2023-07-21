<form role="search" method="get" class="search-form flex flex-row items-end w-full block max-w-1400 border-b border-r border-black pr-6 pl-0 py-2" action="{{ esc_url( home_url( '/' ) ) }}">
    <label class="flex-1 mr-1 md:mr-4">
        <span class="sr-only">{{ _x( 'Search for:', 'label' ) }}</span>
        <input type="search" id=""
                class="search-field uppercase font-bold text-4xl w-full pt-5" 
                placeholder="{!! esc_attr_x( 'Type to search', 'placeholder' ) !!}" value="{{ get_search_query() }}" name="s" />
    </label>
    <input type="submit" 
            class="cursor-pointer search-submit h-16" 
    value="{!! esc_attr_x( 'Search', 'submit button' ) !!}" />
</form>
  