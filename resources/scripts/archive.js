export default {
    init() {
        var dropdown = document.getElementById( 'archive-tax-dropdown' );
        
        function onCatChange() {
            if ( dropdown.options[ dropdown.selectedIndex ].value.length > 0 ) {
                location.href = dropdown.options[ dropdown.selectedIndex ].value;
            }
        }
        dropdown.onchange = onCatChange;
    }
}