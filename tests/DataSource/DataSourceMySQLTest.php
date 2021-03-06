<?php namespace Falafel\test\Listing;

use Falafel\Column\ColumnBase;
use Falafel\Criteria\CriteriaBase;
use Falafel\DataSource\DataSourceMySQL;

class DataSourceMySQLTest extends \PHPUnit_Framework_TestCase {


	protected $connection;

	public function setUp()
	{
		try {
			$this->connection = new \PDO('mysql:host=localhost;dbname=laravel;charset=utf8', 'migration', 'migrationpass');
			$this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} catch (\PDOException $e) {
			$this->markTestSkipped('Skipping database test due to DB exception');
		}
	}

	public function tearDown()
	{
		unset($this->connection);
	}

	/**
	 * @dataProvider testFetchRowsDataProvider
	 */
	public function testFetchRows($criteria, $testName)
	{

		$ds = new DataSourceMySQL($this->connection, 'laravel.users');
		$rows = $ds->fetchRows($criteria);

		$this->assertInstanceOf('\Falafel\DataSource\PDOIterator', $rows);

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

		$crit7 = new CriteriaBase();
		$crit7->setFields(array('id', 'name', 'email', 'created_at'));
		$crit7->addField('updated_at');
		$crit7->setSort('id', false);
		$crit7->startsWith('name', array('Co', 'Cor'));

		return [
			[ $crit1, 'Equals Test' ],
			[ $crit2, 'Greater Than Test' ],
			[ $crit3, 'Less Than Test' ],
			[ $crit4, 'Starts With Test' ],
			[ $crit5, 'Ends With Test' ],
			[ $crit6, 'Search Test' ],
			[ $crit7, 'OR Test'],
		];
	}

	public function testConditionToWhere()
	{

		// Set up for testing protected method
		$class = new \ReflectionClass('\Falafel\DataSource\DataSourceMySQL');
		$method = $class->getMethod('conditionToWhere');
		$method->setAccessible(true);
		
		$ds = new DataSourceMySQL($this->connection, 'laravel.users');

		$queryParams = array();
		$result = $method->invokeArgs($ds, array('id', 'eq', array(1, 2), &$queryParams));
		$this->assertEquals('id IN(:id_0,:id_1)', trim($result));
	}

	public function testConditionToWhereInvalidComparator()
	{
		$this->setExpectedException('\InvalidArgumentException');
		$class = new \ReflectionClass('\Falafel\DataSource\DataSourceMySQL');
		$method = $class->getMethod('conditionToWhere');
		$method->setAccessible(true);
		
		$ds = new DataSourceMySQL($this->connection, 'laravel.users');

		$queryParams = array();
		$result = $method->invokeArgs($ds, array('id', 'invalidComparator', array(1, 2), &$queryParams));
	}

}
