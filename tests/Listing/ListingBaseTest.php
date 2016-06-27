<?php namespace Falafel\test\Listing;

use Falafel\Column\ColumnBase;
use Falafel\Criteria\CriteriaBase;
use Falafel\DataSource\DataSourceArray;
use Falafel\HTTP\RequestBase;
use Falafel\HTTP\ResponseBase;
use Falafel\Listing\ListingBase;

class ListingBaseTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider testExecDataProvider
	 */
	public function testExec($criteria)
	{
		$request = new RequestBase($criteria);
		$response = new ResponseBase();
		$dataSource = new DataSourceArray(
			array(
				array('id' => 1, 'username' => 'coryjamesfisher', 'first_name' => 'Cory'  , 'last_name' => 'Fisher'),
				array('id' => 2, 'username' => 'karathenurse'   , 'first_name' => 'Kara'  , 'last_name' => 'Fisher'),
				array('id' => 3, 'username' => 'llizano'        , 'first_name' => 'Lucila', 'last_name' => 'Lizano')
			)
		);

		$listing = new ListingBase();
		$listing->setDataSource($dataSource);
		$listing->addColumnDef('id', new ColumnBase('id'));
		$listing->addColumnDef('username', new ColumnBase('username'));
		$listing->addColumnDef('first_name', new ColumnBase('first_name'));
		$listing->addColumnDef('last_name', new ColumnBase('last_name'));
		$listing->exec($request, $response);

		$this->assertInstanceOf('\Falafel\Listing\ListingBase', $listing);
		$this->assertInstanceOf('\Falafel\HTTP\RequestBase', $request);
		$this->assertInstanceOf('\Falafel\HTTP\ResponseBase', $response);
		$this->assertInstanceOf('\Falafel\Criteria\CriteriaBase', $request->getCriteria());

		ob_start();
		$response->send();
		$response_output = ob_get_clean();

		$this->assertNotEmpty($response_output);
	}

	public function testExecDataProvider()
	{
		$testCriteria1 = new CriteriaBase();
		$testCriteria1->eq('id', 1);
		$testCriteria1->setLimit(1);

		$testCriteria2 = new CriteriaBase();
		$testCriteria2->ne('id', 1);
		$testCriteria2->setLimit(1);

		return [
			[ $testCriteria1 ],
			[ $testCriteria2 ]
		];
	}
}
