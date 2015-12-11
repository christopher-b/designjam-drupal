jQuery(function(){
  // Nav menu toggle
  var $nav = jQuery('#primary-nav'),
      $navControl = jQuery('#nav-toggle'),
      initialHeight = $nav.css('height');

  navContract();
  $navControl.click(function(){
    $nav.attr('aria-expanded') == 'true' ? navContract() : navExpand();
  });
  $nav.find('li a').click(navContract);
  $nav[0].addEventListener("transitionend", updateHeight);
  function navExpand() {
    $nav.attr       ('aria-expanded', true);
    $navControl.attr('aria-expanded', false);
    $nav.css('max-height', initialHeight);
  }
  function navContract(){
    $nav.attr('aria-expanded', false);
    $navControl.attr('aria-expanded', false);
    $nav.css('max-height', '0px');
  }
  function updateHeight() {
    // Remove max-height, in case initialHeight != actual height
    if($nav.css('height') != '0px') {
      $nav.css('max-height', '');
      initialHeight = $nav.css('height');
      $nav.css('max-height', initialHeight);
    }
  }


  // Collapse when nav menu links are clicked
  // jQuery('#navbar-links li a').click(function(){
  //   jQuery('#navbar-links').collapse('hide')
  // })

  // Fix smooth scrolling
  // https://www.drupal.org/node/2396391
  // jQuery('a[href*=#]:not([href=#])').click(function() {
  //   if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
  //     var target = jQuery(this.hash);
  //     target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
  //     if (target.length) {
  //       jQuery('html,body').animate({
  //         scrollTop: target.offset().top
  //       }, 1000);
  //       return false;
  //     }
  //   }
  // });
});
