<?php namespace DataSource;

use Criteria\CriteriaInterface;

interface DataSourceInterface {

	public function fetchRows(CriteriaInterface $criteria);
	public function fetchColumn(CriteriaInterface $criteria);
}