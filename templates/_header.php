<?php if (!empty($title)): ?>
  <?php print render($title_prefix); ?>
    <div class="page-header">
      <h1><?php print $title; ?></h1>
    </div>
  <?php print render($title_suffix); ?>
<?php endif; ?>
<?php if (!empty($tabs)): ?>
  <?php print render($tabs); ?>
<?php endif; ?>
