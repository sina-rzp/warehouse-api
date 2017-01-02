$(document).ready(function(){

    //owl carousel - initiations

    //banner carousel on home page
    $('#carouselHomeBanner').owlCarousel({
        autoplay: true,
        loop:true,
        dots:true,
        items: 1
    });

    //product carousel on home page
    function initializeFreshBaskets(){
        var containerWidth = $(window).width();
        var centerFreshBasketsFlag = false;
        if(containerWidth <= 767) {
            centerFreshBasketsFlag = true;
        } else {
            centerFreshBasketsFlag = false;
        }
        $('#carouselFreshBaskets').owlCarousel({
            center: centerFreshBasketsFlag,
            autoplay: true,
            dots: false,
            nav:true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            responsive:{
                480:{
                    items:3
                },
                992:{
                    items:4
                }
            }
        });
    }

    initializeFreshBaskets();
    var throttle1;
    $(window).resize( function() {
        clearTimeout(throttle1);
        throttle1 = setTimeout(initializeFreshBaskets, 500);
    });

    //mobile navigation carousel on listing pages
    function initializeCategoryMobile(){
        var containerWidth = $(window).width();
        if(containerWidth < 992) {
            if($('#carouselCategoryMobile .owl-stage-outer').length <= 0){
                $('#carouselCategoryMobile').owlCarousel({
                    autoWidth:true,
                    center: true,
                    dots: false,
                    nav:false,
                    responsive:{
                        480:{
                            items:4
                        },
                        768:{
                            items:6
                        }
                    }
                });
                $('#carouselCategoryMobile').addClass('owl-carousel');
                calcML = $(window).width()/2 - 15 - $('#carouselCategoryMobile .owl-item:first-child').width()/2;
                $('#carouselCategoryMobile .owl-stage').css('margin-left', -Math.abs(calcML) );
            }
        } else {
            $('#carouselCategoryMobile').trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
            $('#carouselCategoryMobile').find('.owl-stage').children().unwrap();
        }
    }

    initializeCategoryMobile();
    var throttle2;
    $(window).resize( function() {
        clearTimeout(throttle2);
        throttle2 = setTimeout(initializeCategoryMobile, 500);
        calcML = $(window).width()/2 - 15 - $('#carouselCategoryMobile .owl-item:first-child').width()/2;
        $('#carouselCategoryMobile .owl-stage').css('margin-left', -Math.abs(calcML) );
        // console.log(throttle2);
    });

       //navigation carousel article listing pages
    function initializeArticleCategoryMobile(){
                $('#carouselArticleCategoryMobile').owlCarousel({
                    autoWidth:true,
                    dots: false,
                    nav:true,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                    responsive:{
                        480:{
                            items:4
                        },
                        768:{
                            items:6
                        }
                    }
                });
    }

    initializeArticleCategoryMobile();

        //navigation carousel inspiration listing pages as articles
    function initializeRecipeCategoryMobile(){
                $('#carouselRecipeCategoryMobile').owlCarousel({
                    autoWidth:true,
                    dots: false,
                    nav:true,
                    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                    responsive:{
                        480:{
                            items:4
                        },
                        768:{
                            items:6
                        }
                    }
                });
    }

    initializeRecipeCategoryMobile();

    //brand carousel on featured brands page
    $('#carouselFeaturedBrands').owlCarousel({
        autoplay: true,
        // loop: true,
        dots: false,
        nav: false,
        // navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsive:{
            0:{
                items:2
            },
            480:{
                items:4
            },
            992:{
                items:7
            }
        }
    });

    //masonry - initiation
    setTimeout(function(){
        $('.masonry-journal').masonry({
            // options
            itemSelector: '.masonry-item',
            columnWidth: '.masonry-sizer',
            percentPosition: true
        });

        $('#carouselFreshBaskets .owl-nav').appendTo($('#home-freshbaskets'));
    }, 500);   

    //dialogfeed - initiation
    if($('#myFreshBytes').length > 0) {
        $.getJSON('https://users.dialogfeed.com/en/snippet/cold-storage.json?api_key=92f6eab38bc0cc5fdaa635e731cd27f2', function(data) {
            var $content = $('#ugc_content'),
                posts = data.news_feed.posts.post,
                str = '';
                posts = posts.splice(0, 20);

            $.each(posts, function(k, p) {
                str += '<div class="ugc-post" id="post_'+ k +'" style="background-image: url('+ p.content.content_picture +')">';
                str += '<div class="ugc-content">';
                str += '<div class="ugc-content-header">';
                str += '<a href="'+ p.image_url +'" target="_blank"><i class="fa fa-instagram"></i></a>'
                str += '</div>';
                str += '<div class="ugc-content-body">';
                str += p.fct.auto_link_message == null? '' : p.fct.auto_link_message;
                str += '</div>';
                str += '<div class="ugc-content-footer">';
                str += '<div class="ugc-content-author-img"><img src="'+ p.author.picture_url +'" alt="'+ p.author.name +'"></div>';
                str += '<div class="ugc-content-author-name"><a href="'+ p.author.url +'" target="_blank">'+ p.author.name +'</a></div>';
                str += '<div class="ugc-content-author-love"><a href="'+ p.image_url +'" target="_blank" title="Like"><i class="fa fa-heart"></i></a></div>';
                str += '</div>';
                str += '</div>';
                str += '</div>';
                $content.append(str);
            });

            $('#ugc_content').owlCarousel({
                nav: true,
                dots: false,
                slideBy: 'page',
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            });

            setTimeout(function(){
                $('#ugc_content .owl-nav').appendTo($('#myFreshBytes'));
            }, 500);
        });
    }

    //match height - initiation
    $('.match-height').matchHeight();

});