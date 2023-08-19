export default {
    init() {
        let quotes = $('.wp-block-pullquote p');

        quotes.each( (index, quote) => {
            // console.log(quote);
            let text = quote.textContent.split(' ');
            let spanBreak = parseInt((text.length * .45));
            text.splice(spanBreak, 0, '<span class="pullquote-outline">');
            text.push('</span>');
            text = text.join(' ');
            
            $(quote).html(text);
        });

        let emailBtn = $('#botanica');
        let speakerEmail = emailBtn.data('omega') + '@' + emailBtn.data('alpha');
        emailBtn.on('click', () => { location.href='mailto:' + speakerEmail });
    },
};