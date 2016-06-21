<?php namespace Criteria;

class CriteriaBase implements CriteriaInterface
{

	protected $page;
	protected $limit;
	protected $sortField;
	protected $sortDirectionDesc;
	protected $fields;
	protected $criteria = array();

	public function getPage()
	{
		return $this->page;
	}

	public function setPage($page)
	{
		$this->page = $page;
	}

	public function getLimit()
	{
		return $this->limit;
	}

	public function setLimit($limit)
	{
		$this->limit = $limit;
	}

	public function eq($column_id, $value)
	{
		$this->criteria['eq'][$column_id] = is_array($value) ? $value : array($value);
	}

	public function ne($column_id, $value)
	{
		$this->criteria['ne'][$column_id] = is_array($value) ? $value : array($value);
	}

	public function gt($column_id, $value)
	{
		$this->criteria['gt'][$column_id] = is_array($value) ? $value : array($value);
	}

	public function lt($column_id, $value)
	{
		$this->criteria['lt'][$column_id] = is_array($value) ? $value : array($value);
	}

	public function startsWith($column_id, $value)
	{
		$this->criteria['startsWith'][$column_id] = is_array($value) ? $value : array($value);
	}

	public function endsWith($column_id, $value)
	{
		$this->criteria['endsWith'][$column_id] = is_array($value) ? $value : array($value);
	}

	public function search($column_id, $value)
	{
		$this->criteria['search'][$column_id] = is_array($value) ? $value : array($value);
	}

	public function setFields($fields)
	{
		$this->fields = $fields;
	}

	public function getFields()
	{
		return $this->fields;
	}

	public function addField($field)
	{
		$this->fields[$field] = $field;
	}

	public function setSort($field, $sortDirectionDesc = true)
	{
		$this->sortField = $field;
		$this->sortDirectionDesc = $sortDirectionDesc;
	}

	public function getSortField()
	{
		return $this->sortField;
	}

	public function getSortDirectionDesc()
	{
		return $this->sortDirectionDesc;
	}
}