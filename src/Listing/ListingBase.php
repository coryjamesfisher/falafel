<?php namespace Falafel\Listing;


use Falafel\Column\ColumnInterface;
use Falafel\Criteria\CriteriaInterface;
use Falafel\DataSource\DataSourceInterface;
use Falafel\http\RequestInterface;
use Falafel\http\ResponseInterface;
use Falafel\Renderer\RendererHTML;
use Falafel\Renderer\RendererInterface;

class ListingBase implements ListingInterface
{

	protected $dataSource = null;
	protected $renderer = null;
	protected $columnDefs = array();

	public function __construct()
	{
		$this->setRenderer(self::getDefaultRenderer());
	}

	/** @return Listing */
	public function setDataSource(DataSourceInterface $dataSource)
	{
		$this->dataSource = $dataSource;
	}

	/** @return DataSourceInterface */
	public function getDataSource()
	{
		return $this->dataSource;
	}

	/** @return Listing */
	public function setRenderer(RendererInterface $renderer)
	{
		$this->renderer = $renderer;
	}

	/** @return RendererInterface */
	public function getRenderer()
	{
		return $this->renderer;
	}

	/** @return Listing */
	public function addColumnDef($column_id, ColumnInterface $column)
	{
		$this->columnDefs[$column_id] = $column;
	}

	/** @return Listing */
	public function setColumnDefs($columns)
	{
		$this->columnDefs = $columns;
	}

	/** @return ColumnInterface[] */
	public function getColumnDefs()
	{
		return $this->columnDefs;
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
		$response->setBodyCallback(function() use ($request) {

			$rows = $this->getDataSource()->fetchRows($request->getCriteria());

			$this->getRenderer()->render($this->getColumnDefs(), $rows);
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

	protected static function getDefaultRenderer()
	{
		return new RendererHTML();
	}
}
