<?php

class ApplicationPage extends Page {

	private static $db = array(
    'HTMLAttribute' => 'VarChar(100)',
    'HTMLValue' => 'VarChar(100)',
		'BodyAttribute' => 'VarChar(100)',
		'BodyValue' => 'VarChar(100)',
		'ApplicationHTML' => 'HTMLText',
		'ApplicationJavascript' => 'HTMLText',
	);

	static $many_many = array(
    'ApplicationLibraries' => 'ApplicationLibrary'
  );

	function getCMSFields() {
    $fields = parent::getCMSFields();
    $application = new Application();
    $fields = $application->getApplicationCMSFields($fields, $this);
 		return $fields;
  }

}


class ApplicationPage_Controller extends Page_Controller {

	public function init(){
		parent::init();

    Requirements::javascript("https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js");
    // Requirements::javascript("singlepageapplications/javascript/bind.js");

    foreach ($this->Owner->ApplicationLibraries()->sort('LoadOrder') as $library) {
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

