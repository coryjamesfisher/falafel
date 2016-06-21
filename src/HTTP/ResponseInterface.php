<?php namespace HTTP;

interface ResponseInterface
{

	/**
	 * @note Writes to STDOUT
	 * @note Must also output any HTTP headers
	 */
	public function send();

	/**
	 * @param Callable $callback
	 * @return void
	 */
	public function setBodyCallback($callback);
}