<?php
class EventFinder extends EntityFieldQuery {
  function __construct() {
    $this->entityCondition('entity_type', 'node');
    $this->entityCondition('bundle', 'event');
    $this->propertyCondition('status', 1); // published
  }

  function bigTent() {
    return $this->fieldCondition('field_event_type', 'value', 'bigtent');
  }

  function after($date) {
    return $this->fieldCondition('field_date', 'value2', $date, '>=');
  }

  function before($date) {
    return $this->fieldCondition('field_date', 'value2', $date, '<');
  }

  function sort($field, $order='asc') {
    return $this->fieldOrderBy("field_$field", 'value', $order);
  }

  function find() {
    $result = $this->execute();
    if(empty($result)) { return null; }

    $events = array();
    $node_ids = array_keys($result['node']);
    $entities = entity_load('node', $node_ids);
    foreach($entities as $entity) {
      $events[] = new Event($entity);
    }
    return $events;
  }
}

class Event {
  public $node_id;
  public $title;
  public $summary;
  public $description;
  public $shownotes;
  public $start_date;
  public $end_date;
  public $location;
  public $location_name;
  public $eventbrite_id;
  public $eventbrite_url;
  public $path;
  public $image;
  public $thumbnail;
  public $people = array();

  function __construct($entity) {
    $this->node_id         = $entity->nid;
    $this->path            = 'node/'.$this->node_id;
    $this->title           = $entity->title;
    @$this->summary        = $entity->body[LANG][0]['summary'];
    @$this->description    = $entity->body[LANG][0]['value'];
    @$this->shownotes      = $entity->field_shownotes[LANG][0]['value'];
    @$this->start_date     = $entity->field_date[LANG][0]['value'];
    @$this->end_date       = $entity->field_date[LANG][0]['value2'];
    @$this->location       = $entity->field_location[LANG][0]['value'];
    @$this->location_name  = $entity->field_location_name[LANG][0]['value'];
    @$this->eventbrite_id  = $entity->field_eventbrite_id[LANG][0]['value'];
    @$this->eventbrite_url = 'https://www.eventbrite.ca/e/'.$this->eventbrite_id;
    @$this->image          = $entity->field_event_image[LANG][0];
    @$this->thumbnail      = $entity->field_thumbnail_image[LANG][0];

    if(!empty($entity->field_people)){
      foreach($entity->field_people[LANG] as $person) {
        $person = new Person($person['tid']);
        $this->people[] = $person;
      }
    }
  }

  function isPast() {
    return $this->end_date < time();
  }

  function day() {
    return date('l M j, Y', $this->start_date);
  }

  function timespan() {
    // Show time span, or "All day"
    $startTimeFormat = (date('i', $this->start_date) == '00') ? 'ga' : 'g:ia';
    $endTimeFormat   = (date('i', $this->end_date)   == '00') ? 'ga' : 'g:ia';
    if(date('G', $this->start_date) == '0' && date('G', $this->end_date) == '0') {
      $time = 'All day';
    }
    else {
      $startTime = date($startTimeFormat, $this->start_date);
      $endTime   = date($endTimeFormat,   $this->end_date);
      $time = $startTime."&ndash;".$endTime;
    }
    return $time;
  }

  function render_image() {
    if($this->image){
      $this->image['path'] = $this->image['uri']; // theme_image() requires 'path'
      $this->image['attributes'] = [];
      return theme_image($this->image);
    }
    else { return ''; }
  }

  function render_thumbnail() {
    if($this->thumbnail){
      $this->thumbnail['path'] = $this->thumbnail['uri']; // theme_image() requires 'path'
      $this->thumbnail['attributes'] = [];
      if(empty($this->thumbnail['alt'])) {
        $this->thumbnail['alt'] = 'Event thumbnail image';
      }
      return theme_image($this->thumbnail);
    }
    else { return ''; }
  }

}
