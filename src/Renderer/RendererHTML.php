<?php namespace Renderer;

class RendererHTML implements RendererInterface
{

	public function render($columnDefs, $rows)
	{
		echo "<html><body><table>";

		echo "<thead>";
		foreach ($columnDefs as $columnDef) {
			$columnDef->getRenderer()->renderHead();
		}
		echo "</thead>";

		echo "<tbody>";
		foreach ($rows as $row) {

			echo "<tr>";
			foreach ($columnDefs as $columnDef) {
				$columnDef->getRenderer()->renderCell($row);
			}
			echo "</tr>";
		}
		echo "</tbody>";

		foreach ($columnDefs as $columnDef) {
			$columnDef->getRenderer()->renderFoot();
		}

		echo "</table></body></html>";
	}
}