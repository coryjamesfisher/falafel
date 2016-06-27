<?php namespace Falafel\Renderer;

use Falafel\Column\ColumnInterface;

interface ColumnRendererInterface
{

	public function setColumn(ColumnInterface $column);
	public function renderHead();
	public function renderCell($row);
	public function renderFoot();
}
