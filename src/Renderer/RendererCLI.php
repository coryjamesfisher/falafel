<?php namespace Falafel\Renderer;

class RendererCLI implements RendererInterface
{

	public function render($columnDefs, $rows)
	{
		foreach ($columnDefs as $columnDef) {
			$columnDef->getRenderer()->renderHead();
		}

		echo PHP_EOL;

		foreach ($rows as $row) {

			foreach ($columnDefs as $columnDef) {
				$columnDef->getRenderer()->renderCell($row);
			}
			echo PHP_EOL;
		}

		foreach ($columnDefs as $columnDef) {
			$columnDef->getRenderer()->renderFoot();
		}

		echo PHP_EOL;

	}
}
