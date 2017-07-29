<?php

class Site_flash_message{
    
    public $title;
    public $text;
    public $type;   // success , info , warning , danger
    
    public function __construct($title = "" , $text = "" , $type="success") {
        $this->title = $title;
        $this->text = $text;
        $this->type = $type;
    }
    
}