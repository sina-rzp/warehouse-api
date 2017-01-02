//search button click - show search bar 
$('.btn-search').click(function(e){
    e.preventDefault();
    $('.nav-search-form').fadeToggle('fast');
    if($(window).width() > 992 ){
        $(this).css('margin-left', "-20px");
        $('.primary-links').css('margin-right', "20px");
    }
});

//mobile navigation (for listings) - show dropdown
$('.nav-listing-mob-header').click(function(){
    $(this).toggleClass('collapse');
});

//back to top button click - scroll up lah
$('#back-to-top').click(function(){
    console.log('up!');
    $('html,body').animate({
            scrollTop: 0
        }, 500);
});

//bitesize select (footer) click - change sharing links
$('#select-bitesize-month').change(function(){
    encodedBitesizeUrl = encodeURIComponent( $(this).val() );
    selectBitesizeEl = $('#select-bitesize-month');

    shareFb = 'https://www.facebook.com/dialog/feed?app_id=296363624084064'
        + '&link=' + encodedBitesizeUrl 
        + '&picture=' + $(selectBitesizeEl).attr('data-fbpicture') 
        + '&name=' + $(selectBitesizeEl).attr('data-fbname')
        + '&caption=' + $(selectBitesizeEl).attr('data-fbcaption') 
        + '&description=' + $(selectBitesizeEl).attr('data-fbdescription') 
        + '&redirect_uri=' + $(selectBitesizeEl).attr('data-fbredirect');
        
    shareTw = 'https://twitter.com/home?status=' + $(selectBitesizeEl).attr('data-twstatus') + encodedBitesizeUrl;

    $('#btn-download-bitesize').attr('href', $(this).val());
    $('#btn-share-fb-bitesize').attr('href', shareFb);
    $('#btn-share-tw-bitesize').attr('href', shareTw);
});

//fix nav bar + show bitesize download on scroll  (desktop only)
$(document).scroll(function(){
    if($(window).width() > 992 ){
        if( $(window).scrollTop() > $('#secondary-nav').height() ){
            $('header').addClass('navbar-fixed-header');
            $('body').css('margin-top', $('#primary-nav').height());
        } else{
            $('header').removeClass('navbar-fixed-header');
            $('body').css('margin-top', '0');
            $('.nav-search-form').fadeOut('fast');
        }
    }    
});

    // smoothscroll to #id function
    function dataScroll(id) {
        console.log(id);
        var $header = $('#primary-nav');
        var $target = $(id);
        console.log($header.height());
        if($(window).width() <= 991){
            $header = $('.navbar');
        }
        
        var offset = $target.offset().top - $header.height();
        // console.log(offset);
        // console.log($header.height() , $target.offset().top);

        $('html, body').animate({'scrollTop': offset}, 450); 
    }