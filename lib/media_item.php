<?php
class MediaItem {

  const REGEXP_VIMEO = '/http[s]?:\/\/vimeo.com\/(\d+)/';

  public $vid;          // vocabulary ID
  public $node;         //  node object
  public $title;
  public $url;
  public $attachment_data;  // Attachment associative array
  public $file;             // File object

  public $copyright_holder;
  public $usage_rights;
  public $creators = array();


  public function __construct($node) {
    if(is_numeric($node)) { $node = node_load($node); }
    $this->node = $node;

    $this->vid               = $node->vid;
    $this->title             = $node->title;
    @$this->url              = $node->field_url['und'][0]['value'];
    @$this->copyright_holder = $node->field_copyright_holder['und'][0]['value'];
    @$this->usage_rights     = $node->field_usage_rights['und'][0]['value'];

    if(!empty($node->field_creator)){
      foreach($node->field_creator['und'] as $creator) {
        $person = new Person($creator['tid']);
        $this->creators[] = $person;
      }
    }

    if(!empty($node->field_attachment)) {
      $this->attachment_data = $node->field_attachment['und'][0];
      $this->file = file_load($this->attachment_data['fid']);
      $this->file->description = $this->title;
    }
    // print_r($node);
    // $node->promote;
    // $node->sticky;
    // $node->field_attachment;
    // $node->field_subject;
    // $node->field_event;
  }

  public function person_list() {
    $links = array();
    foreach ($this->creators as $creator) {
      $links[] = "<a href='{$creator->url()}'>{$creator->name}</a>";
    }
    // print_r($links);die;
    return to_sentence($links);
  }

  public function embed() {
    switch ($this->media_type()) {
      case 'vimeo':
        return $this->_embed_vimeo();
      case 'attachment':
        return $this->_embed_attachment();
      default:
        return $this->_embed_link();
    }
  }

  public function media_type() {
    if(!empty($this->attachment_data)) { return 'attachment'; }
    if( preg_match(self::REGEXP_VIMEO, $this->url) === 1) { return 'vimeo'; }
    return 'external_link';
  }

  protected function _embed_attachment() {
    // file_create_url($this->attachment_data['uri']);
    return theme_file_link(array('file'=>$this->file));
  }

  protected function _embed_vimeo() {
    preg_match(self::REGEXP_VIMEO, $this->url, $matches);
    $vimeo_id = $matches[1];
    return "<div class='embed-container'><iframe src='//player.vimeo.com/video/${vimeo_id}?byline=0' frameborder='0' webkitallowfullscreen='' mozallowfullscreen='' allowfullscreen=''></iframe>
    </div>
    <p class='caption'>With {$this->person_list()}</p>
    ";
  }

  protected function _embed_link() {
    return "<a href='{$this->url}' target='_blank'>{$this->title}</a> (External link)";
  }

}
