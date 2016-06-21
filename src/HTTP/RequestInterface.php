<?php namespace HTTP;

use Criteria\CriteriaInterface;

interface RequestInterface
{

	/** @return RequestInterface */
	public function setCriteria(CriteriaInterface $criteria);

	/** @return CriteriaInterface*/
	public function getCriteria();
}