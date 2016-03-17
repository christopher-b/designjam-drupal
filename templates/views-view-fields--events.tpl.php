<?php
/**
 * View template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 */
?>
<?php $event = new Event($row->_field_data['nid']['entity']); ?>

<div class="event-card clearfix">
  <h3 class="event-card-title">
    <?php echo l($event->title, $event->path);?>
  </h3>
  <div class="event-card-meta">
    <span><i class="icon icon_calendar"></i><?php print $event->day(); ?></span>
    <span><i class="icon icon_clock"></i><?php print $event->timespan(); ?></span>
    <?php if(isset($event->location_name)):?>
      <span><i class="icon icon_location"></i><?php print $event->location_name;?></span>
    <?php endif;?>
  </div>
  <div class="event-card-description">
    <?php print $event->summary;?>
  </div>
  <div class="event-card-register ">
    <?php if($event->isPast()) : ?>
      <?php // Do nothing ?>
    <?php elseif(isset($event->eventbrite_id)) : ?>
      <?php $url = 'https://www.eventbrite.ca/e/'.$event->eventbrite_id; ?>
      <a href="<?php echo $url;?>" target="_blank" class="button green">
        Register at Eventbrite
      </a>
    <?php else: ?>
      <span>Coming soon</a>
    <?php endif;?>
  </div>
</div>
