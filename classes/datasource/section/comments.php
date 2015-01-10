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
	
	public function query_comments($ds_id = NULL, $document_id = NULL, array $ids = NULL)
	{
		$query = DB::select($this->table() . '.*')
			->from($this->table())
			->select(array('users.username', 'user_name'))
			->select(array('users.email', 'user_email'))
			->join('users', 'left')
				->on('users.id', '=', $this->table() . '.user_id');

		if($ds_id !== NULL)
		{
			$query->where('ds_id', '=', (int) $ds_id);
			if ($document_id !== NULL)
			{
				$query->where('document_id', '=', (int) $document_id);
			}
		}
		
		if (!empty($ids))
		{
			$query->where('id', 'in', $ids);
		}

		return $query;
	}
	
	public function get_comments($ds_id = NULL, $document_id = NULL, array $ids = NULL)
	{
		return $this
			->query_comments($ds_id, $document_id, $ids)
			->select($this->table() . '.*')
			->select(array('datasources.name', 'ds_name'))
			->join('datasources', 'left')
				->on('datasources.id', '=', $this->table() . '.ds_id')
			->select(array('users.username', 'user_name'))
			->select(array('users.email', 'user_email'))
			->join('users', 'left')
				->on('users.id', '=', $this->table() . '.user_id')
			->order_by('created_on', 'desc')
			->order_by('status')
			->execute()
			->as_array('id');
	}
	
	public function count_comments($ds_id = NULL, $document_id = NULL, array $ids = NULL)
	{
		return $this
			->query_comments($ds_id, $document_id, $ids)
			->select(array(DB::expr('COUNT(*)'), 'total'))
			->execute()
			->get('total');
	}
}