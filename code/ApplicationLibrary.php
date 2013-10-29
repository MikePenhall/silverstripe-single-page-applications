<?php

class ApplicationLibrary extends DataObject{

	static $db = array(
		'Name' => 'VarChar(50)',
		'Version' => 'VarChar(50)',
		'URL' => 'VarChar(500)',
    'Sort' => 'Int'
	);

  public static $default_sort='SortOrder';

	static $belongs_many_many = array(
    'Pages' => 'Page',
    'ApplicationPages' => 'ApplicationPage'
  );

	function getCMSFields() {
    $fields = parent::getCMSFields();
    $fields->removeByName('Sort');
    $fields->push(new TextField('Name', 'The library name eg. Angular'));
    $fields->push(new TextField('Version', 'The version number of the library eg. 1.2'));
    $fields->push(new TextField('URL', 'The url to load the library itself'));
    return $fields;
  }


}