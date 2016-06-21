<?php namespace HTTP;

use Criteria\CriteriaInterface;

class RequestBase implements RequestInterface
{

	/**
	 * @var CriteriaInterface
	 */
	protected $criteria;

	public function __construct(CriteriaInterface $criteria = null)
	{
		$this->criteria = $criteria;
	}

	/** @return RequestInterface */
	public function setCriteria(CriteriaInterface $criteria)
	{
		$this->criteria = $criteria;
		return $this;
	}

	/** @return CriteriaInterface */
	public function getCriteria()
	{
		return $this->criteria;
	}
}