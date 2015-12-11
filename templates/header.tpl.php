<header role="banner" class="site-header-wrapper">
  <div class="site-header">
    <nav>
      <div class="logo">
        <a href="<?php print $front_page; ?>" title="Home">
          <img src="<?php print $logo; ?>" alt="DesignJam">
        </a>
      </div>
      <button id="nav-toggle" type="button" aria-controls="primary-nav">
        MENU
      </button>
      <?php
      if (!empty($page['navigation'])):
          print render($page['navigation']);
      endif;
      ?>
    </nav>
  </div>
</header>
