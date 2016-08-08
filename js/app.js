jQuery(function(){
  var $ = jQuery;
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

  // Toolbox Animations
  $('.toolbox-item').hover(
    function(){ $(this).addClass('animated pulse') },
    function(){ $(this).removeClass('animated pulse') }
  );

  // Toolbox category filters
  $('.toolbox-filter input').change(function(event){
    var category = $('input[name=category-filter]:checked').val()
    var type     = $('input[name=type-filter]:checked').val()
    var duration = $('input[name=duration-filter]:checked').val()

    // var categoryId = $(event.target).val();
    $('.toolbox-item').each(function(){
      var $this = $(this);
      var itemCategory = $this.attr('data-toolbox-category');
      var itemType = $this.attr('data-toolbox-type');
      var itemDuration = $this.attr('data-toolbox-duration');
      // var show = false;
      if(undefined != category && (category != 0 && itemCategory != category)){
        return $this.hide();
        // show = true;
      }
      if(undefined != type && (type != 'all' && itemType != type)){
        return $this.hide();
        // show = true;
      }
      if(undefined != duration && (duration != 'all' && itemDuration != duration)){
        return $this.hide();
        // show = true;
      }
      $this.show();
      // show ? $this.show() : $this.hide();
    });

  });
});
