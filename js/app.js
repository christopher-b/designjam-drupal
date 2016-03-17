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
});
