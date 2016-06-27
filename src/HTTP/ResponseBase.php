<?php namespace Falafel\HTTP;

class ResponseBase implements ResponseInterface
{

	protected $bodyCallback;

	public function setBodyCallback($callback)
	{
		$this->bodyCallback = $callback;
	}

	/**
	 * @note Writes to STDOUT
	 * @note Must also output any HTTP headers
	 */
	public function send()
	{
		$this->sendHeaders();
		$this->sendBody();
	}

	public function sendHeaders()
	{
		header('HTTP/1.0 200 OK');
	}

	public function sendBody()
	{

		if ($this->bodyCallback === null) {
			return;
		}

		$callback = $this->bodyCallback;
		$callback();
	}
}
