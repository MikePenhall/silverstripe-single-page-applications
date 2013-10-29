<?php

class ApplicationPageDecorator extends DataExtension {

	public static $many_many = array(
		'Application' => 'Application'
	);

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