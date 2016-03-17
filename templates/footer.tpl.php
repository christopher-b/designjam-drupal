<div class="sponsors-wrapper">
  <div class="sponsors">
    <?php print render($page['page-bottom']); ?>
  </div>
</div>

<div class="site-footer-wrapper">
  <footer class="site-footer grid">
    <section class="contact col-1-3">
      <h2>Contact</h2>
      <ul>
        <li class="email">
          <a href="mailto:designjam@ocadu.ca?subject=DesignJam">designjam@ocadu.ca</a>
        </li>
        <li class="twitter">
          <a href="https://twitter.com/designjamca" target="_blank">@DesignJamCA</a>
        </li>
        <?php print render($page['footer-col1']); ?>
      </ul>
    </section>

    <span class="sep"></span>

    <section class="links col-1-3">
      <?php print render($page['footer-col2']); ?>
    </section>

    <span class="sep"></span>

    <section class="license col-1-3">
      <?php print render($page['footer-col3']); ?>
    </section>

    <span class="clearfix"></span>
  </footer>

  <!-- <div class="container">
    <?php print render($page['footer']); ?>
  </div> -->
</div>
