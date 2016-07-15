<?php namespace Falafel\DataSource;

use Falafel\Criteria\CriteriaInterface;

class DataSourceArray implements DataSourceInterface
{

	protected $rows = array();

	public function __construct($rows)
	{
		$this->rows = $rows;
	}

	public function fetchRows(CriteriaInterface $criteria)
	{

		$matches = new \ArrayIterator();
		$filters = $criteria->getFilters();

		foreach ($this->rows as $row) {


			if (array_key_exists('eq', $filters)) {

				$matched = false;
				foreach ($filters['eq'] as $filter_column => $filter_values) {

					foreach ($filter_values as $filter_value) {

						if ($row[$filter_column] == $filter_value) {
							$matched = true;
						}
					}
				}

				if ($matched == false) {
					continue;
				}
			}

			if (array_key_exists('ne', $filters)) {

				$matched = false;
				foreach ($filters['ne'] as $filter_column => $filter_values) {

					foreach ($filter_values as $filter_value) {

						if ($row[$filter_column] != $filter_value) {
							$matched = true;
						}
					}
				}

				if ($matched == false) {
					continue;
				}
			}

			if (array_key_exists('lt', $filters)) {

				$matched = false;
				foreach ($filters['lt'] as $filter_column => $filter_values) {

					foreach ($filter_values as $filter_value) {

						if (floatval($row[$filter_column] < floatval($filter_value))) {
							$matched = true;
						}
					}
				}

				if ($matched == false) {
					continue;
				}
			}

			if (array_key_exists('gt', $filters)) {

				$matched = false;
				foreach ($filters['gt'] as $filter_column => $filter_values) {

					foreach ($filter_values as $filter_value) {

						if (floatval($row[$filter_column] > floatval($filter_value))) {
							$matched = true;
						}
					}
				}

				if ($matched == false) {
					continue;
				}
			}

			if (array_key_exists('startsWith', $filters)) {

				$matched = false;
				foreach ($filters['startsWith'] as $filter_column => $filter_values) {

					foreach ($filter_values as $filter_value) {

						if (strpos($row[$filter_column], $filter_value) === 0) {
							$matched = true;
						}
					}
				}

				if ($matched == false) {
					continue;
				}
			}

			if (array_key_exists('endsWith', $filters)) {

				$matched = false;
				foreach ($filters['endsWith'] as $filter_column => $filter_values) {

					foreach ($filter_values as $filter_value) {
						if (strrpos($row[$filter_column], $filter_value) === (strlen($row[$filter_column]) - strlen($filter_value))) {
							$matched = true;
						}
					}
				}

				if ($matched == false) {
					continue;
				}
			}

			if (array_key_exists('search', $filters)) {

				$matched = false;
				foreach ($filters['search'] as $filter_column => $filter_values) {

					foreach ($filter_values as $filter_value) {

						if (strstr($row[$filter_column], $filter_value)) {
							$matched = true;
						}
					}
				}

				if ($matched == false) {
					continue;
				}
			}

			$matches->append($row);

		}

		return $matches;
	}

	public function fetchColumn(CriteriaInterface $criteria)
	{
		return $this->rows;
	}
}
