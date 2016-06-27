<?php namespace Falafel\Renderer;

use Falafel\Column\ColumnInterface;

class ColumnRendererCLI implements ColumnRendererInterface
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
		echo '|' . str_pad($this->column->getKey(), 10, ' ', STR_PAD_BOTH) . '|';
	}

	public function renderCell($row)
	{
		echo '|' . str_pad($row[$this->column->getKey()], 10, ' ') . '|';
	}

	public function renderFoot()
	{
		// TODO: Implement renderFoot() method.
	}
}
