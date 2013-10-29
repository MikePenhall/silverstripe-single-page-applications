<?php

class ApplicationPage extends Page {

		public function HTMLAttr(){
        if($this->Application() && $this->Application()->HTMLAttribute && $this->Application()->HTMLValue){
            return $HTMLAttribute="$this->HTMLValue";
        }
    }

    public function BodyAttr(){
        if($this->Application() && $this->Application()->BodyAttribute && $this->Application()->BodyValue){
            return $BodyAttribute="$this->BodyValue";
        }
    }

    public function ApplicationLibraries(){
      if($this->Application()->ApplicationLibraries()){
        $libraries = new ArrayList;
        foreach ($this->Application()->ApplicationLibraries()->sort('LoadOrder') as $library) {
          $link = array();
          $type = preg_split("/./",$library);
          $type = end($type);
          $link['type'] = $type;
          $link['url'] = trim($library->URL);
          $libraries->push($link);
        }
        return $libraries;
      }
      return false;
    }

    public function ApplicationHTML(){
        if($this->Application()){
            return $this->Application()->ApplicationHTML;
        }
    }

    public function ApplicationJavascript(){
        if($this->Application()){
            return $this->Application()->ApplicationJavascript;
        }
    }

}

class ApplicationPage_Controller extends Page_Controller {


}