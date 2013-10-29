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
    $fields->removeByName('Content');
    $fields->push(new LiteralField('HTMLHeading', "Add an attribute to the page's html node if required."));
    $fields->push(new TextField('HTMLAttribute', "Attribute <strong>name</strong> to add to page's html tag"));
  	$fields->push(new TextField('HTMLValue', "Attribute <strong>value</strong> to add to page's html tag"));
    $fields->push(new LiteralField('BodyHeading', "Add an attribute to the page's body node if required."));
    $fields->push(new TextField('BodyAttribute', "Attribute <strong>name</strong> to add to page's body tag"));
    $fields->push(new TextField('BodyValue', "Attribute <strong>value</strong> to add to page's body tag"));
    $html = new TextAreaField('ApplicationHTML', 'Enter Your Application HTML here');
    $html->setRows(25);
   	$fields->push($html);
   	$js = new TextAreaField('ApplicationJavascript', 'Enter Your Application Javascript here');
   	$js->setRows(25);
    $fields->push($js);
    $fields->addFieldToTab('Root.Libraries', new LiteralField('', '<h2>Add Libraries</h2><br />Select or add an libraries you would like your app to use. JQuery is included by default.'));

    $config = GridFieldConfig_RelationEditor::create(10);
    $config->addComponent(new GridFieldOrderableRows());

    $config->getComponentByType('GridFieldDataColumns')->setDisplayFields(array(
      'Sort' => 'Sort Order',
      'Name' => 'Name',
      'Version' => 'Version'
    ));


    $gridField = new GridField(
      "ApplicationLibraries", // Field name
      "ApplicationLibraries", // Field title
      $this->ApplicationLibraries(), // List of all related libraries
      $config
    );

    $fields->addFieldToTab('Root.Libraries', $gridField);

 		return $fields;
  }

}


class ApplicationPage_Controller extends Page_Controller {

	public function init(){
		parent::init();

    Requirements::javascript("https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js");

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

