(function ($) {
  Drupal.behaviors.InitMenu = {
    attach: function (context, settings) {
      $("#menu ul.menu .expanded").hover(
        function () {
          var subMenu = $(this).find("ul.menu:first");
          if($(this).parents('li.expanded').length){
            subMenu.show();
            subMenu.css('margin-left', $(this).width() + parseInt($(this).css('padding-left')));
            subMenu.css('top', 0);
          }
          else{
            subMenu.show();
          }
        },
        function () {
          $(this).find("ul.menu:first").hide();
        }
      );
    }
  }
  Drupal.behaviors.InitDesign = {
    attach: function (context, settings) {
      $('span.group-expand').each(function(){
        $(this).click(function(){
          var group = $(this).nextUntil('').next();
          if(group.hasClass('closed')){
            group.removeClass('closed');
            $(this).removeClass('closed');
            group.addClass('opened');
            $(this).addClass('opened');
          }
          else{
            group.removeClass('opened');
            $(this).removeClass('opened');
            group.addClass('closed');
            $(this).addClass('closed');
          }

        })
      })


      var carousel = $("#carousel").featureCarousel({
            trackerIndividual:    false,
            trackerSummation:     false,
            largeFeatureWidth :   411,
            largeFeatureHeight:		231,
            smallFeatureWidth:      411,
            smallFeatureHeight:		231,
            stopOnHover:          true,
            topPadding:           30,
            // spacing between the sides of the container
            sidePadding:          0,
            // the additional offset to pad the side features from the top of the carousel
            smallFeatureOffset:		-20
        // include options like this:
        // (use quotes only for string values, and no trailing comma after last option)
        // option: value,
        // option: value
      });

      $("#but_prev").click(function () {
        carousel.prev();
      });
      $("#but_pause").click(function () {
        carousel.pause();
      });
      $("#but_start").click(function () {
        carousel.start();
      });
      $("#but_next").click(function () {
        carousel.next();
      });

      if(jQuery().jcarousel) {
        $('.clients-slider ul.client-items').jcarousel({
          'scroll':1,
          'visible':5
        });
      }
    }
  }
})(jQuery);
