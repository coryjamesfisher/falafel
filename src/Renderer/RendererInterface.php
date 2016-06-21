<?php namespace Renderer;

interface RendererInterface
{

	public function render($columnDefs, $rows);
}