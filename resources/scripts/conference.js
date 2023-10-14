

export default {
    init() {
        const closePanelBtns = document.querySelectorAll('.rounded-panel.odd .expansion-toggle');
        const firstPlaceholder = document.querySelector('.grid-placeholder.rounded-panel'); // grab just the first placeholder
 
        for (const closePanelBtn of closePanelBtns) {
            closePanelBtn.addEventListener('click', () => {
            //   hideCards();
            //   scrollToPanel(scrollItem);
                console.log('eyyyyy');
                firstPlaceholder.classList.toggle('hidden');
            });
        }
    }
}