<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * @package Datasource
 * @category Category
 */
class Datasource_Section_Comments_Headline extends Datasource_Section_Headline {

	public function get( array $ids = NULL )
	{
		return $this->_section->get_comments();
	}
	
	public function count_total( array $ids = NULL ) 
	{  
		return 0;
	}
}