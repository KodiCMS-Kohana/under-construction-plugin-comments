<?php defined('SYSPATH') or die('No direct access allowed.');

/**
 * @package Datasource
 * @category Category
 */
class Datasource_Section_Comments_Headline extends Datasource_Section_Headline {

	public function get(array $ids = NULL)
	{
		$results = array(
			'total' => 0,
			'documents' => array()
		);
		
		$pagination = $this->pagination($ids);
		
		$query = $this->_section->query_comments($this->get_ds_id(), $this->get_document_id(), $ids);
		
		$result = $query
			->limit($this->limit())
			->offset($this->offset())
			->execute()
			->as_array('id');
		
		if (count($result) > 0)
		{
			$results['total'] = $pagination->total_items;
			$fetched_documents = array();

			foreach ($result as $id => $row)
			{
				$document = new DataSource_Comments_Document($this->_section);
				$document->id = $id;
				$documents[$id] = $document
					->read_values($row);
				
				if (!empty($row['ds_id']) AND !empty($row['document_id']))
				{
					$fetched_documents[$row['ds_id']]['docs'][] = $row['document_id'];
				}
			}
			
			foreach ($fetched_documents as $ds_id => $data)
			{
				$datasource = Datasource_Section::load($ds_id);
				
				if($datasource instanceof Datasource_Section)
				{
					$fetched_documents[$ds_id]['ds'] = $datasource;
					$fetched_documents[$ds_id]['docs'] = $datasource->get_document_headers($data['docs']);
				}
			}

			foreach ($documents as $document)
			{
				if(isset($fetched_documents[$document->ds_id]['docs'][$document->document_id]))
				{
					$document->ds_source = $fetched_documents[$document->ds_id]['ds'];
					$document->document_name = $fetched_documents[$document->ds_id]['docs'][$document->document_id];
				}
			}

			$results['documents'] = $documents;
		}
		
		return $results;
	}
	
	public function count_total(array $ids = NULL)
	{
		return $this->_section->count_comments($this->get_ds_id(), $this->get_document_id(), $ids);
	}
	
	public function get_ds_id()
	{
		return Request::initial()->query('source_ds_id');
	}
	
	public function get_document_id()
	{
		return Request::initial()->query('document_id');
	}
}