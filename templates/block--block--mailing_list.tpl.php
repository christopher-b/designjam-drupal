<?php
/**
 * Template for "Mailing List" block
 */
?>
<section id="<?php print $block_html_id; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="container">
    <form>
      <label for="email">Sign Up for our newsletter</label>
      <input type="text" id="email" />
      <input type="submit" value="Sign Up" class="button green" />
    </form>

    <?php print $content ?>
  </div>
</section>
