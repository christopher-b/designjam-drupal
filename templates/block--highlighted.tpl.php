<?php
/**
 * Template for "highlighted" blocks
 */
?>


<?php //if ($block->region == 'highlighted'): ?>
  <!-- <a name="" /> -->
<?php //endif; ?>

<section id="<?php print $block_html_id; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php //print $block->css_class; ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <?php print render($title_prefix); ?>

        <?php if (isset($title)): ?>
          <h2<?php print $title_attributes; ?>><?php print $title; ?></h2>
        <?php endif;?>
        <?php print render($title_suffix); ?>

        <?php print $content ?>
      </div>
    </div>
  </div>
</section>
