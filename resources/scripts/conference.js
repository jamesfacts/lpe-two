

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
                let scrollItem = $(target).closest('.panel-card').attr('id');

                firstPlaceholder.classList.toggle('hidden');
                scrollToPanel(scrollItem);
            });
        }

        for (const closeEvenPanel of closeEvenPanelBtns) {
            closeEvenPanel.addEventListener('click', (ev) => {
            //   scrollToPanel(scrollItem);
                firstPlaceholder.classList.remove('hidden');
            });
        }
    }
}