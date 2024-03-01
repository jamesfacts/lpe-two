export default {
    init() {
        // Sets a cookie for us.
        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = 'expires='+d.toUTCString();
            document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/';
            //+ 'SameSite=Strict; Secure'
        }

        // Grabs a cookie for us.
        function getCookie(cname) {
            var name = cname + '=';
            var ca = document.cookie.split(';');
            for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
            }
            return '';
        }

        function updateFrontEnd() {
            let allItems = $('article.reading-item');

            allItems.each((index, element) => {
                let itemStatus = getCookie($(element).data('reading'));

                if(itemStatus === '1'){
                    $(element).find('.reading-status').text('In Progress');
                    $(element).find('.progress-tracker').addClass('underway');
                }
                if(itemStatus === '2'){
                    $(element).find('.reading-status').text('Complete');
                    $(element).find('.progress-tracker').removeClass('underway');
                    $(element).find('.progress-tracker').addClass('complete');
                }
            });
        }

        updateFrontEnd();

        $('.progress-tracker').on('click', function(ev){
            if( $(ev.currentTarget).hasClass('complete') ) {
                $(ev.currentTarget).removeClass('complete');
                $(ev.currentTarget).find('.reading-status').text('Not Started');
                // setCookie()

                let readingValue = $(ev.currentTarget).parent().data('reading');
                setCookie(readingValue, 0, 30);
                console.log(readingValue);
            }
            else if($(ev.currentTarget).hasClass('underway')) {
                $(ev.currentTarget).removeClass('underway').addClass('complete');
                $(ev.currentTarget).find('.reading-status').text('Complete');

                let readingValue = $(ev.currentTarget).parent().data('reading');
                setCookie(readingValue, 2, 30);
                console.log(readingValue);
            } else {
                $(ev.currentTarget).addClass('underway');
                $(ev.currentTarget).find('.reading-status').text('In Progress');

                let readingValue = $(ev.currentTarget).parent().data('reading');
                setCookie(readingValue, 1, 30);
                console.log(readingValue);
            }
        });
    },
};