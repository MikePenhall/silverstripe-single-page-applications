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
    'ApplicationLibraries' => 'ApplicationLibrary'
  );



}