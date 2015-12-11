<?php
/**
 * Template for "Toolbox" block
 */
?>

<a class="anchor" name="toolbox" id="toolbox"></a>
<section id="<?php print $block_html_id; ?>" class="<?php print $classes; ?> highlight clearfix"<?php print $attributes; ?>>
  <div class="container clearfix">
    <div class="description">
      <?php print render($title_prefix); ?>
      <h2<?php print $title_attributes; ?> class="toolbox-title">
        <?php print $block->subject; ?>
        <img src="<?php print path_to_theme();?>/img/icon_toolbox.png" alt="Toolkit icon" />
      </h2>
      <?php print render($title_suffix); ?>

      <?php print $content ?>
      <div class="links">
        <a href="/toolbox" class="button blue">DesignJam Toolbox</a>
      </div>
    </div>
    <div class="media">
      <div class="embed-container">
         <iframe src="//player.vimeo.com/video/117632942?byline=0" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
       </div>
    </div>
  </div>
</section>
