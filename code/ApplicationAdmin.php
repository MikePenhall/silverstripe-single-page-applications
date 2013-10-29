<?php

class ApplicationsAdmin extends ModelAdmin {

 	public static $managed_models = array(
    'Application'
  );

	static $has_many = array(
    'Applications' => 'Application'
  );

  static $url_segment = 'applications-admin';

  static $menu_title = 'Applications';

}

?>
