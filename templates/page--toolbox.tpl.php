<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
   * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>
<?php
$toolbox_taxonomy = taxonomy_vocabulary_machine_name_load('toolbox');
$themes = taxonomy_get_tree($toolbox_taxonomy->vid, 0, $max_depth = 1, true);
// print_r($themes);
?>
<?php include './'. path_to_theme() .'/templates/header.tpl.php';?>
<div class="page-content-wrapper page toolbox">
  <div class="page-meta-wrapper">
    <div class="page-meta-container">
      <?php if (!empty($messages)): ?>
        <div class="row messages">
          <?php print $messages; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($page['help'])): ?>
        <?php print render($page['help']); ?>
      <?php endif; ?>

      <?php if (!empty($action_links)): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
    </div>
  </div>

  <a id="main-content"></a>
  <div class="page-header-wrapper">
    <header class="page-header clearfix grid">
      <h1><?php print $title; ?></h1>
      <div class="page-description col-3-4">
        <?php print render($page['content']); ?>
      </div>
    </header>
  </div>

  <section class="page-body-wrapper">
    <div class="page-body">
      <?php if (!empty($tabs)){ print render($tabs); } ?>
      <div class="videos"> </div>

      <p class="cta">What do you aspire to learn?</p>
      <p class="cta-sub">Select a topic below for workshop videos, handouts and more</p>

      <div class="themes grid">
        <?php foreach($themes as $theme) : ?>
          <?php $theme_url = url( taxonomy_term_uri($theme)['path'] ); ?>
          <a href="<?php echo $theme_url;?>">
            <div class="card card-<?php echo slug($theme->name);?> col-1-2">
              <h3><span><?php echo $theme->name; ?></span></h3>
              <hr />
              <p><?php echo $theme->description; ?></p>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <div class="toolbox-gallery-wrapper">
    <aside class="page-content toolbox-gallery">
      <h2>Photo Gallery</h2>
      <?php // https://flickrit.com/index.php ?>
      <div style='position: relative; padding-bottom: 76%; height: 0; overflow: hidden;'>
        <iframe id='iframe' src='//flickrit.com/slideshowholder.php?height=75&size=big&speed=stop&count=100&setId=72157649341997433&click=true&counter=true&credit=2&thumbnails=0&transition=0&layoutType=responsive&sort=0' scrolling='no' frameborder='0'style='width:100%; height:100%; position: absolute; top:0; left:0;' ></iframe>
      </div>
      <!-- <a data-flickr-embed="true"  href="https://www.flickr.com/photos/130435212@N04/albums/72157649341997433" title="DesignJam Toronto: Activities"><img src="https://farm9.staticflickr.com/8708/16799248119_4ea94c088c_b.jpg" width="992" height="683" alt="DesignJam Toronto: Activities"></a><script async src="//embedr.flickr.com/assets/client-code.js" charset="utf-8"></script> -->
    </aside>
  </div>

</div>
<?php include './'. path_to_theme() .'/templates/footer.tpl.php';?>
