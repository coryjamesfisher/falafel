<?php namespace Falafel\Renderer;

interface RendererInterface
{

	public function render($columnDefs, $rows);
}
