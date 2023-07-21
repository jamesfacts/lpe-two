<form role="search" method="get" class="search-form flex flex-row items-end w-full block max-w-1400" action="{{ esc_url( home_url( '/' ) ) }}">
    <label class="flex-1 mr-1 md:mr-4">
        <span class="sr-only">{{ _x( 'Search for:', 'label' ) }}</span>
        <input type="search" id="search-field"
                class="pl-0 block appearance-none w-full pt-1 text-base border-b border-creamsicle bg-darknavy text-white" 
                placeholder="{!! esc_attr_x( 'Type to search', 'placeholder' ) !!}" value="{{ get_search_query() }}" name="s" />
    </label>
    <input type="submit" 
            class="search-submit inline-block border border-white px-2 py-1 uppercase bg-khaki cursor-pointer" 
    value="{{ esc_attr_x( 'Search', 'submit button' ) }}" />
</form>
  