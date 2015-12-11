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
  public $description;
  public $summary;
  public $start_date;
  public $end_date;
  public $location;
  public $location_name;
  public $eventbrite_id;
  public $eventbrite_url;
  public $path;

  function __construct($entity) {
    // print_r($entity);die;
    $this->node_id        = $entity->nid;
    $this->title          = $entity->title;
    $this->start_date     = $entity->field_date['und'][0]['value'];
    $this->end_date       = $entity->field_date['und'][0]['value2'];
    $this->description    = $entity->body['und'][0]['value'];
    $this->summary        = $entity->body['und'][0]['summary'];
    $this->location       = $entity->field_location['und'][0]['value'];
    $this->location_name  = $entity->field_location_name['und'][0]['value'];
    $this->eventbrite_id  = $entity->field_eventbrite_id['und'][0]['value'];
    $this->eventbrite_url = 'https://www.eventbrite.ca/e/'.$this->eventbrite_id;
    $this->path           = 'node/'.$this->node_id;
  }

}
