<?php
/**
 * Template for "BigTent Events" block
 */

// Display Upcoming and Last BigTent
$startOfToday = strtotime("midnight", REQUEST_TIME);
$date_format = 'D. M. j, Y';

$eventFinder = new EventFinder();
$events = $eventFinder
  ->bigTent()
  ->after($startOfToday)
  ->sort('date')
  ->range(0, 1)
  ->find();
$upcoming = $events[0];

$eventFinder = new EventFinder();
$events = $eventFinder
  ->bigTent()
  ->before($startOfToday)
  ->sort('date', 'desc')
  ->range(0, 1)
  ->find();
$past = $events[0];
?>

<a class="anchor" name="bigtent" id="bigtent"></a>
<section id="<?php print $block_html_id; ?>" class="<?php print $classes; ?> clearfix highlight" <?php print $attributes; ?>>
  <div class="container clearfix grid">

    <div class="description col-1-2">
      <?php print render($title_prefix); ?>
      <a href="/bigtent">
        <h2 <?php print $title_attributes; ?> class="bigtent-title">
          <?php print $block->subject; ?>
          <img src="<?php print path_to_theme();?>/img/icon_bigtent.png" alt="Big Tent icon" class="img-responsive" />
        </h2>
      </a>
      <?php print render($title_suffix); ?>
      <?php print $content ?>
    </div>

    <div class="features col-1-2">
      <?php if($upcoming): ?>
        <div>
          <h2><a href="/bigtent">Featured</a></h2>
          <h3>
            <a href="<?php echo $upcoming->eventbrite_url;?>" target="_blank">
              <?php echo $upcoming->title;?>
            </a>
          </h3>
          <p>
            <?php echo date($date_format, $upcoming->start_date); ?>
            &mdash; <?php echo $upcoming->location_name;?>
          </p>
          <p><?php echo $upcoming->description;?></p>
          <p>
            <a href="<?php echo $upcoming->eventbrite_url;?>" target="_blank" class="button yellow">
              ￼￼Register Now on Eventbrite
            </a>
          </p>
        </div>
      <?php endif; ?>

      <?php if($past): ?>
        <div>
          <h2><a href="/bigtent">Past</a></h2>
          <h3>
            <?php echo l($past->title, $past->path); ?>
          </h3>
          <p>
            <?php echo date($date_format, $past->start_date); ?>
            &mdash; <?php echo $past->location_name;?>
          </p>
          <p><?php echo $past->description;?></p>
        </div>
      <?php endif; ?>
    </div>

    <!--
    <div class="balloon">
      <a href="http://designjam-toronto-mar28.eventbrite.ca/" target="_blank">
        <div class="traffic-jam">
          <div class="traffic-jam-inner">
            <h3>
              <svg viewBox="0 0 100 15">
                <text y="15" x="50%">“TrafficJam”</text>
              </svg>
            </h3>
            <p>
              <svg viewBox="0 0 100 32">
                <text>
                  <tspan x="50%" dy="1.2em">Saturday March 28</tspan>
                  <tspan x="50%" dy="1.2em">MaRS Discovery District</tspan>
                </text>
              </svg>
            </p>
          </div>
        </div>
      </a>
    </div>
    -->

  </div>
</section>
