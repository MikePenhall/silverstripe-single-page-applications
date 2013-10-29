<?php

class Application extends DataObject {

	private static $db = array(
    'Name' => 'VarChar(250)',
    'HTMLAttribute' => 'VarChar(100)',
    'HTMLValue' => 'VarChar(100)',
		'BodyAttribute' => 'VarChar(100)',
		'BodyValue' => 'VarChar(100)',
		'ApplicationHTML' => 'HTMLText',
		'ApplicationJavascript' => 'HTMLText'
	);

  static $belongs_to = array(
    'Page' => 'Page'
  );

	static $many_many = array(
    'ApplicationLibraries' => 'ApplicationLibrary'
  );

	function getCMSFields() {
    $fields = parent::getCMSFields();
		$fields->push(new TextField('Name', "<p>Application Name</p>"));
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
      "Libraries", // Field title
      $this->ApplicationLibraries(), // List of all related libraries
      $config
    );

    $fields->addFieldToTab('Root.Libraries', $gridField);

    $pageID = $this->Page() ? $this->Page()->ID : 0;
    $gridField = new GridField('pages', 'Pages', DataObject::get('SiteTree')->where("ID = {$pageID}"), GridFieldConfig_RelationEditor::create());
    $dataColumns = $gridField->getConfig()->getComponentByType('GridFieldDataColumns');
    $dataColumns->setDisplayFields(array(
      'Title' => 'Title',
      'URLSegment'=> 'URL',
      'LastEdited' => 'Changed'
    ));

    $fields->addFieldToTab('Root.Pages', $gridField);

    return $fields;
  }

}