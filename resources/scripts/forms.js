export default {
    init() {
      // AJAX functionality for the author search dropdown
        let baseUrl = $('#author-search').data('action');
        let urlEndpoint = 'wp-json/lpe_project/v1/search?';
  
        let hideAuthorResults = () => {
          $('.author-li').remove();
          $('#author-search').focus();
          $('.author-results').removeClass('show');
          // $('#authorSearchList').remove();
        }
  
        // this is the handler that comes in when an author is already selected
        let authorItemKeyHandler = (event) => {
          if (event.key === 'ArrowDown') {
            let selected = $('.selected');
  
            console.log($(selected).parent().next());
            // only do something if there is another item to go further down
            if ($(selected).parent().next().length > 0) {
              $('.author-item.selected').removeClass('selected');
              $(selected).parent().next().find('a')
                         .addClass('selected').focus();
            } 
          } else if (event.key === 'ArrowUp') {
            let selected = $('.selected');
  
            // pick a lower author if there another item to go further up
            $('.author-item.selected').removeClass('selected');
  
            if ($(selected).parent().prev().length > 0) {
              $(selected).parent().prev().find('a')
                         .addClass('selected').focus();
            } else {
              // otherwise put the focus back in the input
              $('#author-search').focus();
            }
          } else if (event.key === 'Tab') {
            hideAuthorResults();
            $('.blog-feed a:first').triggerHandler( "focus" );
  
          } else if (event.key === 'Escape') {
            hideAuthorResults();
          }
        };
  
        // this is the handler that moves the selection from the input box to the drop-down area

        $('#author-search').on( 'keyup', (event) => {
            if (event.key === 'Escape') {
                hideAuthorResults();
                // extraneous return for clarity
               return false;
            } else if ( event.key === 'ArrowDown' ) {
  
              let firstResult = $('.author-results .author-item')[0];
                $(firstResult).addClass('selected').focus();
              return false;
  
            } else {
              //wipe out the old results
              $('.author-li').remove();
  
              $.ajax({
                  url: baseUrl + urlEndpoint,
                  data: $('#author-search').serialize(), // form data
                  success: function (data) {
                    //check to make sure the data string isn't empty
                    if($('#author-search').serialize() !== 's=') {
                      data.forEach((author) => {
                        let authorAnchor = $('<a>', {class: 'author-item',
                          text: author.title, href: author.link});
                        let authorLi = $('<li>', {class: 'author-li'})
                          .append(authorAnchor);
                        $('.author-results').append(authorLi);
                        if( $('.author-results.show').length < 1) {
                          $('.author-results').addClass('show');
                        }
                      });
                  
                      $('.author-item').each( (index, markup) => {
                        $(markup).bind('keyup', authorItemKeyHandler);
                      });
                    }
                },
                error: function (error) {
                  console.log(error);
                  let errorMsg = (error.responseJSON.message) ? error.responseJSON.message : 'Sorry, no authors found.';
                  let errorMarkup = $('<li>', {class: 'author-li pl-4', text: errorMsg});
                  $('#authorSearchList').addClass('show').append(errorMarkup);
                },
            });

            if ($('#author-search').serialize() == 's=') {
              hideAuthorResults();
            }
            return false;
          }
      });
  
      $('#author-search').bind('blur', function (target) {
        if (! $(target.relatedTarget).is('a.author-item')) {
          // $('.author-results').removeClass('show');
          hideAuthorResults();
        }
      });

    },
};