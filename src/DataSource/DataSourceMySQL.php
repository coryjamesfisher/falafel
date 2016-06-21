<?php namespace DataSource;

use Criteria\CriteriaInterface;

class DataSourceMySQL implements DataSourceInterface
{

	/**
	 * @param CriteriaInterface $criteria
	 * @return \Iterator
	 */
	public function fetchRows(CriteriaInterface $criteria)
	{
		$mysql = new \PDO('mysql:host=rintintin;dbname=crux;charset=utf8', 'webuser', 'rocky');
		$statement = $mysql->query('select * from crux.users limit 10');

		return new PDOIterator($statement);
	}

	public function fetchColumn(CriteriaInterface $criteria)
	{
		// TODO: Implement fetchColumn() method.
	}
}