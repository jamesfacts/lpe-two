

export default {
    init() {
        const closePanelBtns = document.querySelectorAll('.rounded-panel.odd .expansion-toggle');
        const closeEvenPanelBtns = document.querySelectorAll('.rounded-panel.even .expansion-toggle');
        const firstPlaceholder = document.querySelector('.grid-placeholder.rounded-panel'); // grab just the first placeholder
 
        function scrollToPanel(scrollToItem) {
            $('html, body').animate(
              {
                scrollTop: $(`#${scrollToItem}`).offset().top,
              },
              500,
              'linear'
            );
        }

        for (const closePanelBtn of closePanelBtns) {
            closePanelBtn.addEventListener('click', (ev) => {
                let target = ev.target;
                let scrollItem = $(target).closest('.scroll-position').attr('id');
                scrollToPanel(scrollItem);
                firstPlaceholder.classList.toggle('hidden');
                
            });
        }

        for (const closeEvenPanel of closeEvenPanelBtns) {
            closeEvenPanel.addEventListener('click', (ev) => {
                let target = ev.target;
                let scrollItem = $(target).closest('.scroll-position').attr('id');
                scrollToPanel(scrollItem);
                firstPlaceholder.classList.remove('hidden');
            });
        }
    }
}