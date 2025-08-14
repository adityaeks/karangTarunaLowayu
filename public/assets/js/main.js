(function($) {
    "use strict";

    /* Preloader */
    $(window).on('load', function() {
        $('#preloader-active').delay(450).fadeOut('slow');
        $('body').delay(450).css({ 'overflow': 'visible' });
    });

    /* SlickNav Mobile */
    var menu = $('ul#navigation');
    if (menu.length) {
        menu.slicknav({
            prependTo: ".mobile_menu",
            closedSymbol: '+',
            openedSymbol: '-'
        });
    }

    /* == Slider/komponen lain kamu tetap seperti sebelumnya == */
    // ... weekly-news-active, weekly2-news-active, recent-active, video-items-active, owlCarousel, wow, popup, scrollUp, dll

    /* IMPORTANT:
       JANGAN aktifkan kode yang menambah class .sticky, .sticky-bar, .sticky-flex.
       Biarkan kosong agar tidak bentrok dengan script fixed-on-scroll di atas. */

})(jQuery);