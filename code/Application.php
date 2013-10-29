<?php

class Application extends DataObject {

	private static $db = array(
    'HTMLAttribute' => 'VarChar(100)',
    'HTMLValue' => 'VarChar(100)',
		'BodyAttribute' => 'VarChar(100)',
		'BodyValue' => 'VarChar(100)',
		'ApplicationHTML' => 'HTMLText',
		'ApplicationJavascript' => 'HTMLText'
	);

	static $many_many = array(
		'Pages' => 'Page',
    'ApplicationLibraries' => 'ApplicationLibrary'
  );

	function getCMSFields() {
    $fields = parent::getCMSFields();
		return $this->getApplicationCMSFields($fields);
  }

  public function getApplicationCMSFields($fields, $obj = null){
  	if(!$obj){
  		$obj = $this;
  	}

  	$fields->removeByName('Content');
    $fields->push(new LiteralField('HTMLHeading', "<p>Add an attribute to the page's html node if required.</p>"));
    $fields->push(new TextField('HTMLAttribute', "<p>Attribute <strong>name</strong> to add to page's html tag</p>"));
  	$fields->push(new TextField('HTMLValue', "<p>Attribute <strong>value</strong> to add to page's html tag</p>"));
    $fields->push(new LiteralField('BodyHeading', "<p>Add an attribute to the page's body node if required.</p>"));
    $fields->push(new TextField('BodyAttribute', "<p>Attribute <strong>name</strong> to add to page's body tag</p>"));
    $fields->push(new TextField('BodyValue', "<p>Attribute <strong>value</strong> to add to page's body tag</p>"));
    $html = new TextAreaField('ApplicationHTML', '<p>Enter Your Application HTML here</p>');
    $html->setRows(25);
   	$fields->push($html);
   	$js = new TextAreaField('ApplicationJavascript', '<p>Enter Your Application Javascript here</p>');
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
      $obj->ApplicationLibraries(), // List of all related libraries
      $config
    );

    $fields->addFieldToTab('Root.Libraries', $gridField);

 		return $fields;
  }



}