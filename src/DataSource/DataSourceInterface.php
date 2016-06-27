<?php namespace Falafel\DataSource;

use Falafel\Criteria\CriteriaInterface;

interface DataSourceInterface {

	public function fetchRows(CriteriaInterface $criteria);
	public function fetchColumn(CriteriaInterface $criteria);
}
