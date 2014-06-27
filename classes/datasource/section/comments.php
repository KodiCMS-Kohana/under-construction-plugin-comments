<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * @package Datasource
 * @category Category
 */
class DataSource_Section_Comments extends Datasource_Section {
	
	/**
	 * Таблица раздела
	 * 
	 * @var string
	 */
	protected $_ds_table = 'dscomments';
	
	/**
	 * Тип раздела
	 * 
	 * @var string
	 */
	protected $_type = 'comments';
	
	public function get_comments()
	{
		return array();
	}
}