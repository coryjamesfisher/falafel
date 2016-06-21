<?php namespace Listing;


use Column\ColumnInterface;
use Criteria\CriteriaInterface;
use DataSource\DataSourceInterface;
use http\RequestInterface;
use http\ResponseInterface;
use Renderer\RendererInterface;

class ListingBase implements ListingInterface
{

	/** @return Listing */
	public function setDataSource(DataSourceInterface $dataSource)
	{
		// TODO: Implement setDataSource() method.
	}

	/** @return DataSourceInterface */
	public function getDataSource()
	{
		// TODO: Implement getDataSource() method.
	}

	/** @return Listing */
	public function setRenderer(RendererInterface $renderer)
	{
		// TODO: Implement setRenderer() method.
	}

	/** @return RendererInterface */
	public function getRenderer()
	{
		// TODO: Implement getRenderer() method.
	}

	/** @return Listing */
	public function addColumnDef($column_id, ColumnInterface $column)
	{
		// TODO: Implement addColumnDef() method.
	}

	/** @return Listing */
	public function setColumnDefs($columns)
	{
		// TODO: Implement setColumnDefs() method.
	}

	/** @return ColumnInterface[] */
	public function getColumnDefs()
	{
		// TODO: Implement getColumnDefs() method.
	}

	/** @return ColumnInterface */
	public function getColumnDef($column_id)
	{
		// TODO: Implement getColumnDef() method.
	}

	/** @return void */
	public function exec(RequestInterface $request, ResponseInterface $response)
	{

		// TODO: Implement exec() method.

		// Set the response into callback to avoid holding the entire dataset in memory (for those with cursor ability)
		$response->setBodyCallback(function() {

		});
	}

	/** @note Utility Functions for Retrieving Data */
	public function getColumnValues(CriteriaInterface $criteria, $column_id)
	{
		// TODO: Implement getColumnValues() method.
	}

	public function getRowValues(CriteriaInterface $criteria, $row_number)
	{
		// TODO: Implement getRowValues() method.
	}
}