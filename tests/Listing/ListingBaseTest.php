<?php namespace test\Listing;

use Criteria\CriteriaBase;
use HTTP\RequestBase;
use HTTP\ResponseBase;
use Listing\ListingBase;

class ListingBaseTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider testExecDataProvider
	 */
	public function testExec($criteria)
	{
		$request = new RequestBase($criteria);
		$response = new ResponseBase();
		$listing = new ListingBase();
		$listing->exec($request, $response);

		$this->assertInstanceOf('\Listing\ListingBase', $listing);
		$this->assertInstanceOf('\HTTP\RequestBase', $request);
		$this->assertInstanceOf('\HTTP\ResponseBase', $response);
		$this->assertInstanceOf('\Criteria\CriteriaBase', $request->getCriteria());

		ob_start();
		$response->send();
		$response_output = ob_get_clean();

		$this->assertNotEmpty($response_output);
		echo strlen($response_output);

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
