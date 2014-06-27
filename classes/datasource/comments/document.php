<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * @package Datasource
 * @category Hybrid
 */
class DataSource_Comments_Document extends Datasource_Document {
	
	const APPROVED = 1;
	const SPAM = 2;
	const PENDING = 3;
	
	protected $_system_fields = array(
		'id' => NULL,
		'ds_id' => 0,
		'parent_id' => 0,
		'document_id' => 0,
		'author' => NULL,
		'author_email' => NULL,
		'author_url' => NULL,
		'author_IP' => NULL,
		'content' => NULL,
		'status' => 1,
		'user_id' => NULL,
	);
	
	protected $_default_values = array(
		'status' => self::APPROVED
	);
	
	public function labels()
	{
		return array(
			'id' => __('ID'),
			'ds_id' =>  __('Datasource'),
			'parent_id' => __('Parent comment'),
			'document_id' => __('Document'),
			'author' => __('Name'),
			'author_email' => __('E-mail'),
			'author_url' => __('URL'),
			'author_IP' => __('IP'),
			'content' => __('Comment'),
			'status' => __('Status'),
			'user_id' => __('User')
		);
	}
	
	public function filters()
	{
		return array(
			'id' => array(
				array('intval')
			),
			'ds_id' => array(
				array('intval')
			),
			'parent_id' => array(
				array('intval')
			),
			'document_id' => array(
				array('intval')
			),
			'user_id' => array(
				array('intval')
			)
		);
	}
	
	public function rules()
	{
		return array(
			'ds_id' => array(
				array('numeric')
			),
			'parent_id' => array(
				array('numeric')
			),
			'document_id' => array(
				array('not_empty'),
				array('numeric')
			),
			'author' => array(
				array('not_empty')
			),
			'author_IP' => array(
				array('not_empty'),
				array('ip'),
			),
			'author_email' => array(
				array('email')
			),
			'author_url' => array(
				array('url')
			)
		);
	}
}