<?php declare( strict_types=1 );

namespace Automattic\Domain_Services\Test\Lib\Mock\Psr\Http\Message;

class Client implements \Psr\Http\Client\ClientInterface {
	private Response $mock_response;

	public function set_mock_response( Response $response ): void {
		$this->mock_response = $response;
	}

	/**
	 * Sends a PSR-7 request and returns a PSR-7 response.
	 *
	 * @param \Psr\Http\Message\RequestInterface $request
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 *
	 */
	public function sendRequest( \Psr\Http\Message\RequestInterface $request ): \Psr\Http\Message\ResponseInterface {
		return $this->mock_response;
	}
}