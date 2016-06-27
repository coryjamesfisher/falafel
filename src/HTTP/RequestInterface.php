<?php namespace Falafel\HTTP;

use Falafel\Criteria\CriteriaInterface;

interface RequestInterface
{

	/** @return RequestInterface */
	public function setCriteria(CriteriaInterface $criteria);

	/** @return CriteriaInterface*/
	public function getCriteria();
}
