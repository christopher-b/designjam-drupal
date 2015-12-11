<?php
class Person {
  public $term;
  public $name;
  public $description;
  public $portrait;
  // public $portrait_file;   // File object
  public $twitter;
  public $affiliation;
  public $location;

  public function __construct($term) {
    if(is_numeric($term)) { $term = taxonomy_term_load($term); }
    $this->term = $term;
    $this->name = $term->name;
    $this->description = $term->description;

    if(!empty($term->field_portrait)) {
      $this->portrait = $term->field_portrait['und'][0];
      // $this->portrait_file = file_load($this->portrait_data);
    }

    if(!empty($term->field_twitter)) {
      $this->twitter = $term->field_twitter['und'][0]['value'];
    }
    if(!empty($term->field_affiliation)) {
      $this->affiliation = $term->field_affiliation['und'][0]['value'];
    }
    if(!empty($term->field_location)) {
      $this->location = $term->field_location['und'][0]['value'];
    }
  }

  public function url() {
    return url('taxonomy/term/'.$this->term->tid);
  }

  public function twitter_link() {
    return "<a href='https://twitter.com/{$this->twitter}' target='_blank'>@{$this->twitter}</a>";
  }

  public function render_portrait() {
    $this->portrait['path'] = $this->portrait['uri']; // theme_image() requires 'path'
    return theme_image($this->portrait);
    // $url = file_create_url($this->portrait['uri']);
    // return "<img src='$url' title='{$this->portrait['title']}' alt='{$this->portrait['alt']}'  width='{$this->portrait['width']}' height='{$this->portrait['height']}' />";
  }
}
