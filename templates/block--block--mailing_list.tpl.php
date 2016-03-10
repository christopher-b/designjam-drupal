<?php
/**
 * Template for "Mailing List" block
 */
?>
<section id="<?php print $block_html_id; ?>" class="<?php print $classes; ?> clearfix highlight" <?php print $attributes; ?>>
  <div class="container">
    <!-- Begin MailChimp Signup Form -->
    <div id="mc_embed_signup">
    <form
      action="//eventbrite.us10.list-manage.com/subscribe/post?u=af8d8ca08f9365a828dce0e93&amp;id=dff72a8d92"
      method="post"
      target="_blank"
      id="mc-embedded-subscribe-form" class="validate"
      name="mc-embedded-subscribe-form"
      novalidate>
        <div id="mc_embed_signup_scroll">
          <div class="mc-field-group">
            <label for="mce-EMAIL">Sign Up for our newsletter</label>
            <input type="email" value="" placeholder="Email Address" name="EMAIL" class="required email" id="mce-EMAIL">
          </div>
          <div id="mce-responses" class="clear">
            <div class="response" id="mce-error-response" style="display:none"></div>
            <div class="response" id="mce-success-response" style="display:none"></div>
          </div>
          <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
          <div style="position: absolute; left: -5000px;" aria-hidden="true">
            <input type="text" name="b_af8d8ca08f9365a828dce0e93_dff72a8d92" tabindex="-1" value="">
          </div>
          <div class="clear">
            <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button green">
          </div>
        </div>
    </form>
    </div>
    <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
    <script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='MMERGE3';ftypes[3]='text';fnames[4]='MMERGE4';ftypes[4]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
    <!--End mc_embed_signup-->

    <!-- <form>
      <label for="email">Sign Up for our newsletter</label>
      <input type="text" id="email" />
      <input type="submit" value="Sign Up" class="button green" />
    </form> -->
    <?php print $content ?>
  </div>
</section>
