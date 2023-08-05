export default {
    init() {
        console.log("heyoooo");

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
    },
};