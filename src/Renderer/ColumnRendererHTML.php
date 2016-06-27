<?php namespace Falafel\Renderer;

use Falafel\Column\ColumnInterface;

class ColumnRendererHTML implements ColumnRendererInterface
{

	/**
	 * @var ColumnInterface
	 */
	protected $column;

	public function setColumn(ColumnInterface $column)
	{
		$this->column = $column;
	}

	public function renderHead()
	{
		echo "<th>" . $this->column->getKey() . "</th>";
	}

	public function renderCell($row)
	{
		echo "<td>" . $row[$this->column->getKey()] . "</td>";
	}

	public function renderFoot()
	{
		// TODO: Implement renderFoot() method.
	}
}
