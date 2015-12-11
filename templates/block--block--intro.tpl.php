<?php
/**
 * Template for "intro" block - "What is DesignJam?"
 */
?>
<section id="<?php print $block_html_id; ?>" class="<?php print $classes; ?> highlight" <?php print $attributes; ?> >
  <div class="container clearfix">

    <div class="description clearfix">
      <img src="<?php print path_to_theme();?>/img/photo-2.jpg" alt="Photo" class="photo" />
      <?php print render($title_prefix); ?>
        <h2<?php print $title_attributes; ?>>
          <?php print $block->subject; ?>
        </h2>
      <?php print render($title_suffix); ?>

      <?php print $content ?>
    </div>

    <div class="call-to-action grid clear clearfix">
      <div class="bigtent cta-section col-1-3">
        <a href="#bigtent">
          <div class="image">
            <img src="<?php print path_to_theme();?>/img/icon_bigtent.png" />
          </div>
          <h3>BigTent Events</h3>
        </a>
        <p>Attend our all day workshop in Toronto, March 28th. Hear from industry leaders and learn from experienced mentors.</p>
      </div>

      <div class="events cta-section col-1-3">
        <a href="#workshops">
          <div class="image">
            <img src="<?php print path_to_theme();?>/img/icon_workshops.png" />
          </div>
          <h3>Workshops</h3>
        </a>
        <p>We travel around Ontario too. Attend a workshop in your city.</p>
      </div>

      <div class="toolbox cta-section col-1-3">
        <a href="#toolbox">
          <div class="image">
            <img src="<?php print path_to_theme();?>/img/icon_toolbox.png" />
          </div>
          <h3>Toolbox</h3>
        </a>
        <p>Learn on the go! Our event videos, podcasts and booklets are accessible online.</p>
      </div>
    </div>
  </div>

</section>
