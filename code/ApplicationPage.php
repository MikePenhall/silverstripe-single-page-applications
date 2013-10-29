<?php

class ApplicationPage extends Page {

    public static $belongs_to = array(
      'Application' => 'Application'
    );

		public function HTMLAttr(){
        if($this->Application() && $this->Application()->HTMLAttribute && $this->Application()->HTMLValue){
            return stripslashes("{$this->Application()->HTMLAttribute}\='{$this->Application()->HTMLValue}'");
        }
    }

    public function BodyAttr(){
        if($this->Application() && $this->Application()->BodyAttribute && $this->Application()->BodyValue){
            return stripslashes("{$this->Application()->BodyAttribute}\='{$this->Application()->BodyValue}'");
        }
    }

    public function ApplicationHTML(){
        if($this->Application() && $this->Application()->ApplicationHTML){
            return $this->Application()->ApplicationHTML;
        }
    }

    public function ApplicationJavascript(){
        if($this->Application() && $this->Application()->ApplicationJavascript){
            return $this->Application()->ApplicationJavascript;
        }
    }

    public function Name(){
        if($this->Application() && $this->Application()->Name){
            return $this->Application()->Name;
        }
    }

}

class ApplicationPage_Controller extends Page_Controller {
  public function init(){
    parent::init();

    Requirements::javascript("https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js");

    foreach ($this->Owner->Application()->ApplicationLibraries()->sort('Sort') as $library) {
      $type = preg_split("/./",$library);
      $type = end($type);
      if($type == "css"){
        Requirements::themedCSS("$library->URL");
      } else {
        Requirements::javascript("$library->URL");
      }
    }

  }

}