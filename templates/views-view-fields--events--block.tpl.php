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

<?php
/**
 * Parse date
 */
$startTimestamp = $row->field_field_date[0]['raw']['value'];
$endTimestamp   = $row->field_field_date[0]['raw']['value2'];
$startTimeFormat = (date('i', $startTimestamp) == '00') ? 'ga' : 'g:ia';
$endTimeFormat   = (date('i', $endTimestamp)   == '00') ? 'ga' : 'g:ia';

// Show time span, or "All day"
if(date('G', $startTimestamp) == '0' && date('G', $endTimestamp) == '0') {
  $time = 'All day';
}
else {
  $startTime = date($startTimeFormat, $startTimestamp);
  $endTime   = date($endTimeFormat,   $endTimestamp);
  $time = $startTime."&ndash;".$endTime;
}
$day = date('l M j, Y', $startTimestamp);
$inPast = ($endTimestamp < time());
// $row->field_field_date[0]['raw'][timezone_db] => America/Toronto
// print_r(array_keys($fields));
?>

<div class="event-row clearfix">
  <h3 class="event-row-title"><?php print $fields['title']->content;?></h3>
  <div class="event-row-meta">
    <span><i class="icon icon_calendar"></i><?php print $day; ?></span>
    <span><i class="icon icon_clock"></i><?php print $time; ?></span>
    <?php if(isset($fields['field_location_name'])):?>
      <span><i class="icon icon_location"></i><?php print $fields['field_location_name']->content;?></span>
    <?php endif;?>
  </div>
  <div class="event-row-description">
    <?php print $fields['body']->content;?>
  </div>
  <div class="event-row-register">
    <?php if($inPast) : ?>
      <?php // Do nothing ?>
    <?php elseif(isset($fields['field_eventbrite_id'])) : ?>
      <?php $url = 'https://www.eventbrite.ca/e/'.$fields['field_eventbrite_id']->content; ?>
      <a href="<?php echo $url;?>" target="_blank">
        Register at Eventbrite
      </a>
    <?php else: ?>
      <span class="button green">Coming soon</a>
    <?php endif;?>
  </div>
</div>
