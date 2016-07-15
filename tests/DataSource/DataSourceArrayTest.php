<?php namespace Falafel\test\Listing;

use Falafel\Column\ColumnBase;
use Falafel\Criteria\CriteriaBase;
use Falafel\DataSource\DataSourceArray;

class DataSourceArrayTest extends \PHPUnit_Framework_TestCase {


	/**
	 * @dataProvider testFetchRowsDataProvider
	 */
	public function testFetchRows($criteria, $testName)
	{

		$ds = new DataSourceArray(
			array(
				array(
					'id' => 1,
					'name' => 'Cory Fisher',
					'email' => 'coryjamesfisher@gmail.com',
					'created_at' => time(),
					'updated_at' => time()
				)
			)
		);

		$rows = $ds->fetchRows($criteria);

		$this->assertInstanceOf('\Iterator', $rows);

		$rows->rewind();
		$first = $rows->current();
		$this->assertArrayHasKey('id', $first);	
		$this->assertArrayHasKey('name', $first);	
		$this->assertArrayHasKey('email', $first);	
		$this->assertArrayHasKey('created_at', $first);	
		$this->assertArrayHasKey('updated_at', $first);	
	}

	/**
	 * @dataProvider testFetchRowsNoMatchDataProvider
	 */
	public function testFetchRowsNoMatch($criteria, $testName)
	{

		$ds = new DataSourceArray(
			array(
				array(
					'id' => 1,
					'name' => 'Cory Fisher',
					'email' => 'coryjamesfisher@gmail.com',
					'created_at' => time(),
					'updated_at' => time()
				)
			)
		);

		$rows = $ds->fetchRows($criteria);

		$this->assertInstanceOf('\Iterator', $rows);
		$this->assertEquals(0, count($rows));
	}

	public function testFetchRowsNoMatchDataProvider()
	{
		$crit1 = new CriteriaBase();
		$crit1->setFields(array('id', 'name', 'email', 'created_at', 'updated_at'));
		$crit1->setSort('id', false);
		$crit1->eq('id', array(-1));

		$crit2 = new CriteriaBase();
		$crit2->setFields(array('id', 'name', 'email', 'created_at', 'updated_at'));
		$crit2->setSort('id', false);
		$crit2->gt('id', array(1));

		$crit3 = new CriteriaBase();
		$crit3->setFields(array('id', 'name', 'email', 'created_at', 'updated_at'));
		$crit3->setSort('id', false);
		$crit3->lt('id', array(0));

		$crit4 = new CriteriaBase();
		$crit4->setFields(array('id', 'name', 'email', 'created_at', 'updated_at'));
		$crit4->setSort('id', false);
		$crit4->startsWith('name', array('NOmatch'));

		$crit5 = new CriteriaBase();
		$crit5->setFields(array('id', 'name', 'email', 'created_at', 'updated_at'));
		$crit5->setSort('id', false);
		$crit5->endsWith('name', array('NOmatch'));

		$crit6 = new CriteriaBase();
		$crit6->setFields(array('id', 'name', 'email', 'created_at', 'updated_at'));
		$crit6->setSort('id', false);
		$crit6->search('name', array('Nomatch'));

		$crit7 = new CriteriaBase();
		$crit7->setFields(array('id', 'name', 'email', 'created_at'));
		$crit7->addField('updated_at');
		$crit7->setSort('id', false);
		$crit7->startsWith('name', array('Nomatch', 'Nomatch2'));

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

}
