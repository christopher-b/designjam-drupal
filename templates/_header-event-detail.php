<ol class="breadcrumbs">
  <li><a href="/">Home</a></li>
  <li><a href="/workshops">Workshops</a></li>
  <li><?php print $title; ?></li>
</ol>


<?php $event = new Event($node); ?>
<?php if (!empty($title)): ?>
  <?php print render($title_prefix); ?>
  <div class="event-header-wrapper container clearfix">
    <div class="event-header clearfix">
      <div class="event-header-info col-3-4">
        <h1><?php print $title; ?></h1>
        <div class="event-card-meta">
          <span><i class="icon icon_calendar"></i><?php print $event->day(); ?></span>
          <span><i class="icon icon_clock"></i><?php print $event->timespan(); ?></span>
          <?php if(isset($event->location_name)):?>
            <span>
              <i class="icon icon_location"></i>
              <?php print $event->location_name;?>, <?php print $event->location;?>
            </span>
          <?php endif;?>
        </div>
        <?php if(!$event->isPast() && isset($event->eventbrite_id)): ?>
          <div class="button green">
            <?php $url = 'https://www.eventbrite.ca/e/'.$event->eventbrite_id; ?>
            <a href="<?php echo $url;?>" target="_blank">
              Register at Eventbrite
            </a>
          </div>
        <?php endif; ?>
      </div>
      <div class="event-header-image col-1-4">
        &nbsp;
      </div>
    </div>
  </div>
  <?php print render($title_suffix); ?>
<?php endif; ?>
