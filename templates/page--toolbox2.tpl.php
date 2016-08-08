<?php
/**
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
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>
<?php include './'. path_to_theme() .'/templates/header.tpl.php';?>
<div class="page-content-wrapper">
  <a id="main-content"></a>
  <div class="page-header-wrapper">
    <?php
    if(isset($node)): switch ($node->type):
      case 'event': include '_header-event-detail.php'; break;
      default:      include '_header.php';              break;
    endswitch;
    else :
      include '_header.php';
    endif;
    ?>
  </div>

  <div class="page-body-wrapper">
    <div class="page-body">
      <?php if (!empty($tabs)): ?>
        <div class="page-meta">
          <?php if (!empty($tabs)): print render($tabs); endif; ?>
          <!--
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
          -->
        </div>
      <?php endif;?>
      <?php print render($page['content']); ?>

      <?php
        /* Toolbox! */
        $vocab = taxonomy_vocabulary_machine_name_load('toolbox');
        $categories = [];
        $items = [];
        foreach(taxonomy_get_tree($vocab->vid, 0, null, true) as $term) :
          $parent_id = $term->parents[0];
          if($parent_id === '0') { $categories[$term->tid] = $term; }
          else {
            $items[$term->tid] = $term;
          }
        endforeach;
      ?>
      <div class="page-body">

        <form name="toolbox-filter" class="toolbox-filter">
          <ul class="category-filter">
            <li>
              <input type="radio"
                class="category-filter-input"
                id="category-filter-all"
                name="category-filter"
                value="0">
              <label for="category-filter-all">All</label>
            </li>
            <?php foreach($categories as $category) : ?>
              <li>
                <input type="radio"
                  class="category-filter-input"
                  id="category-filter-<?php echo $category->name;?>"
                  name="category-filter"
                  value="<?php echo $category->tid;?>">
                <label for="category-filter-<?php echo $category->name;?>">
                  <?php echo $category->name;?>
                </label>
                <!-- <span class="category-filter-description">
                  <?php echo($category->description);?>
                </span> -->
              </li>
            <?php endforeach ?>
          </ul>
          <ul class="type-filter">
            <li>
              <input type="radio" name="type-filter" value="all" id="type-filter-all" />
              <label for="type-filter-all">All</label>
            </li>
            <li>
              <input type="radio" name="type-filter" value="activity" id="type-filter-activity" />
              <label for="type-filter-activity">Activity</label>
            </li>
            <li>
              <input type="radio" name="type-filter" value="lecture" id="type-filter-lecture" />
              <label for="type-filter-lecture">Lecture</label>
            </li>
            <li>
              <input type="radio" name="type-filter" value="article" id="type-filter-article" />
              <label for="type-filter-article">Article</label>
            </li>
          </ul>
          <ul class="duration-filter">
            <li>
              <input type="radio" name="duration-filter" value="all" id="duration-filter-all" />
              <label for="duration-filter-all">All</label>
            </li>
            <li>
              <input type="radio" name="duration-filter" value="5" id="duration-filter-5" />
              <label for="duration-filter-5">5 minutes</label>
            </li>
            <li>
              <input type="radio" name="duration-filter" value="10" id="duration-filter-10" />
              <label for="duration-filter-10">10 minutes</label>
            </li>
            <li>
              <input type="radio" name="duration-filter" value="15" id="duration-filter-15" />
              <label for="duration-filter-15">15 minutes</label>
            </li>
            <li>
              <input type="radio" name="duration-filter" value=">15" id="duration-filter-gt15" />
              <label for="duration-filter-gt15">>15 minutes</label>
            </li>
          </ul>
        </form>

        <ul class="toolbox2">
          <?php foreach($items as $item) :?>
            <?php
              // print_r($item);
              // $item->tid;
              $parent_id = $item->parents[0];
              $type = $item->field_type['und'][0]['value'];
              $duration = $item->field_duration['und'][0]['value'];
            ?>
            <li class="toolbox-item"
              data-toolbox-category="<?php echo $parent_id; ?>"
              data-toolbox-type="<?php echo $type; ?>"
              data-toolbox-duration="<?php echo $duration; ?>"
            >
              <h3><?php echo $item->name;?></h3>
              <p><?php echo $item->description;?></p>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
  </div>
</div> <!-- /#page-content-wrapper -->

<?php include './'. path_to_theme() .'/templates/footer.tpl.php';?>
