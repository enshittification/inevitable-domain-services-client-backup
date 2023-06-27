<?php declare( strict_types=1 );
/*
 * Copyright (c) 2022 Automattic, Inc.
 *
 * This file is part of the Automattic Domain Services Client library.
 *
 * The Automattic Domain Services Client library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, see https://www.gnu.org/licenses.
 */

namespace Automattic\Domain_Services_Client\Test\Response;

use Automattic\Domain_Services_Client\{Command, Entity, Response, Test};

class Email_Send_Auth_Code_Test extends Test\Lib\Domain_Services_Client_Test_Case {
	public function test_response_factory_success(): void {
		$domain = new Entity\Domain_Name( 'example.com' );
		$command = new Command\Email\Send\Auth_Code( $domain );

		$response_data = [
			'status' => 200,
			'status_description' => 'Command completed successfully',
			'success' => true,
			'client_txn_id' => 'test-client-transaction-id',
			'server_txn_id' => 'a819578a-6101-43cb-b55f-d1986215804b.local-isolated-test-request',
			'timestamp' => 1669075524,
			'runtime' => 0.0021,
			'data' => [
				'email' => 'info@email.com',
			],
		];

		/** @var Response\Email\Send\Auth_Code $response_object */
		$response_object = $this->response_factory->build_response( $command, $response_data );

		$this->assertInstanceOf( Response\Email\Send\Auth_Code::class, $response_object );

		$this->assertIsValidResponse( $response_data, $response_object );
		$email_address = $response_object->get_email()->get_email_address();
		$this->assertSame( $response_data['data']['email'], $email_address );
	}
}
