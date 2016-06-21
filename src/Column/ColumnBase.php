<?php namespace Column;

use Renderer\ColumnRendererHTML;
use Renderer\ColumnRendererInterface;

class ColumnBase implements ColumnInterface
{

	protected $key;

	/**
	 * @var ColumnRendererInterface
	 */
	protected $renderer;

	public function __construct($key = null)
	{
		// Set up the default renderer
		$this->setRenderer(self::getDefaultRenderer());
		$this->setKey($key);
	}

	public function getKey()
	{
		return $this->key;
	}

	public function setKey($key)
	{
		$this->key = $key;
	}

	public function getRenderer()
	{
		return $this->renderer;
	}

	public function setRenderer(ColumnRendererInterface $renderer)
	{
		$this->renderer = $renderer;
		$this->renderer->setColumn($this);
	}

	protected static function getDefaultRenderer()
	{
		return new ColumnRendererHTML();
	}
}