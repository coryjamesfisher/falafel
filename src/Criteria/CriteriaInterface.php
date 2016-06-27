<?php namespace Falafel\Criteria;

interface CriteriaInterface
{

	public function getPage();
	public function setPage($page);

	public function getLimit();
	public function setLimit($limit);

	public function getFilters();
	public function eq($column_id, $value);
	public function ne($column_id, $value);
	public function gt($column_id, $value);
	public function lt($column_id, $value);

	public function startsWith($column_id, $value);
	public function endsWith($column_id, $value);
	public function search($column_id, $value);

	public function setFields($fields);
	public function addField($field);
	public function getFields();

	public function setSort($field, $desc = true);
	public function getSortField();
	public function getSortDirectionDesc();

}
