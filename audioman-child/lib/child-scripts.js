jQuery( document ).ready(function($) {
    // console.log( "ready!" );

    $('.lightbox-inline').magnificPopup({
      type:'inline',
      midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
    });
    if($('.wp-block-gallery').length){
      var imgUrls = [],
          bgCarousel = '<div class="bg-carousel">';
      $('.wp-block-gallery img').each(function(){
        imgUrls.push($(this).attr('src'));
        bgCarousel += '<div class="bg-carousel-slide absolute-fill" style="background:url('+ $(this).attr('src') +') no-repeat center center; background-size:cover;"></div>';
      });
      bgCarousel += '</div>';
      $('body.home .custom-header .wrapper').prepend(bgCarousel);
    }
    function slickInit(){
      $('.bg-carousel').hide();
      $('.bg-carousel').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 15000,
        speed: 3000,
        arrows:false,
        fade: true
      });
      $('.bg-carousel').fadeIn();
    }
    slickInit();

});
