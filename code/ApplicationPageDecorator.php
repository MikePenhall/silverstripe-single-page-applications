<?php

class ApplicationPageDecorator extends DataExtension {

	public static $has_one = array(
		'Application' => 'Application'
	);

    public function AppHTML(){
        if($this->Application && $this->Application->HTMLAttribute && $this->Application->HTMLValue){
            return $HTMLAttribute="$HTMLValue";
        }
    }

    public function AppBody(){
        if($this->Application && $this->Application->BodyAttribute && $this->Application->BodyValue){
            return $BodyAttribute="$BodyValue";
        }
    }


}

class ApplicationPage_ControllerDecorator extends DataExtension {

	public function init(){
		Debug::Show('Mike!');
		parent::init();

    Requirements::javascript("https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js");
    Requirements::javascript("singlepageapplications/javascript/bind");

    // foreach ($this->Owner->ApplicationLibraries()->sort('LoadOrder') as $library) {
    //   $type = preg_split("/./",$library);
    //   $type = end($type);
    //   if($type == "css"){
    //     Requirements::themedCSS("$library->URL");
    //   } else {
    //     Requirements::javascript("$library->URL");
    //   }
    // }

	}
}

?>