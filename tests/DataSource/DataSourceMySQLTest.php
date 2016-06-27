<?php namespace test\Listing;

use Column\ColumnBase;
use Criteria\CriteriaBase;
use DataSource\DataSourceMySQL;

class DataSourceMySQLTest extends \PHPUnit_Framework_TestCase {


	/**
	 * @dataProvider testFetchRowsDataProvider
	 */
	public function testFetchRows($criteria, $testName)
	{


		$ds = new DataSourceMySQL('laravel.users');
		$rows = $ds->fetchRows($criteria);

		$this->assertInstanceOf('\DataSource\PDOIterator', $rows);

		$rows->rewind();
		$first = $rows->current();
		$this->assertArrayHasKey('id', $first);	
		$this->assertArrayHasKey('name', $first);	
		$this->assertArrayHasKey('email', $first);	
		$this->assertArrayHasKey('created_at', $first);	
		$this->assertArrayHasKey('updated_at', $first);	
	}

	public function testFetchRowsDataProvider()
	{
		$crit1 = new CriteriaBase();
		$crit1->setFields(array('id', 'name', 'email', 'created_at', 'updated_at'));
		$crit1->setSort('id', false);
		$crit1->eq('id', array(1));

		$crit2 = new CriteriaBase();
		$crit2->setFields(array('id', 'name', 'email', 'created_at', 'updated_at'));
		$crit2->setSort('id', false);
		$crit2->gt('id', array(0));

		$crit3 = new CriteriaBase();
		$crit3->setFields(array('id', 'name', 'email', 'created_at', 'updated_at'));
		$crit3->setSort('id', false);
		$crit3->lt('id', array(2));

		$crit4 = new CriteriaBase();
		$crit4->setFields(array('id', 'name', 'email', 'created_at', 'updated_at'));
		$crit4->setSort('id', false);
		$crit4->startsWith('name', array('Co'));

		$crit5 = new CriteriaBase();
		$crit5->setFields(array('id', 'name', 'email', 'created_at', 'updated_at'));
		$crit5->setSort('id', false);
		$crit5->endsWith('name', array('isher'));

		$crit6 = new CriteriaBase();
		$crit6->setFields(array('id', 'name', 'email', 'created_at', 'updated_at'));
		$crit6->setSort('id', false);
		$crit6->search('name', array('ory Fis'));


		return [
			[ $crit1, 'Equals Test' ],
			[ $crit2, 'Greater Than Test' ],
			[ $crit3, 'Less Than Test' ],
			[ $crit4, 'Starts With Test' ],
			[ $crit5, 'Ends With Test' ],
			[ $crit6, 'Search Test' ],
		];
	}


	public function testConditionToWhere()
	{

		$this->markTestSkipped('Disabled until reflection & pass by reference can be figured out');
		return;

		// Set up for testing protected method
		$class = new \ReflectionClass('\DataSource\DataSourceMySQL');
		$method = $class->getMethod('conditionToWhere');
		$method->setAccessible(true);
		
		$ds = new DataSourceMySQL('laravel.users');

		$queryParams = array();
		$result = $method->invokeArgs($ds, array('id', 'eq', array(1, 2), $queryParams));

		echo $result;
		print_r($queryParams);
		exit;
	}

}
