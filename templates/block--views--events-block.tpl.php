<?php
/**
 * Template for "Workshops" block
 */
?>

<a class="anchor" name="workshops" id="workshops"></a>
<section id="<?php print $block_html_id; ?>" class="<?php print $classes; ?> highlight  clearfix"<?php print $attributes; ?>>
  <div class="container">
    <?php print render($title_prefix); ?>
    <h2<?php print $title_attributes; ?> class="events-title">
      <a href="/workshops">
        <?php print $block->subject; ?>
        <img src="<?php print path_to_theme();?>/img/icon_workshops.png" alt="Workshops icon" />
      </a>
    </h2>
    <?php print render($title_suffix); ?>
    <?php print $content ?>
  </div>
</section>
