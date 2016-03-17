  <?php if (!empty($title)): ?>
    <?php print render($title_prefix); ?>
      <div class="page-header clearfix">
        <h1><?php print $title; ?></h1>

        <?php if(isset($node) && isset($node->body[LANG][0]['safe_summary'])): ?>
          <div class="page-summary">
            <?php print $node->body[LANG][0]['safe_summary'];?>
          </div>
        <?php endif;?>
      </div>
    <?php print render($title_suffix); ?>
  <?php endif; ?>
