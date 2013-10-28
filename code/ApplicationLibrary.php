<?php

class ApplicationLibrary extends DataObject{

	static $db = array(
		'Name' => 'VarChar(50)',
		'Version' => 'VarChar(50)',
		'URL' => 'VarChar(500)',
    'LoadOrder' => 'Int',
    'Sort' => 'Int'
	);

  public static $default_sort='SortOrder';

	static $belongs_many_many = array(
    'ApplicationPages' => 'ApplicationPage'
  );

	function getCMSFields() {
    $fields = parent::getCMSFields();
    $fields->push(new TextField('Name', 'The library name eg. Angular'));
    $fields->push(new TextField('Version', 'The version number of the library eg. 1.2'));
    $fields->push(new TextField('URL', 'The url to load the library itself'));
    $fields->push(new NumericField('LoadOrder', 'If your libraries are order dependent, specify the order to load it here. The lower the number, the earlier it is called.'));
    return $fields;
  }


}