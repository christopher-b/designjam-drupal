  <?php if (!empty($title)): ?>
    <?php print render($title_prefix); ?>
      <div class="page-header clearfix">
        <h1><?php print $title; ?></h1>
      </div>
    <?php print render($title_suffix); ?>
  <?php endif; ?>
