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

namespace Automattic\Domain_Services\Test\Event;

use Automattic\Domain_Services\{Command, Event, Response, Test};

class Domain_Set_Contacts_Fail_Test extends Test\Lib\Domain_Services_Client_Test_Case {
	public function test_event_success(): void {
		$command = new Command\Event\Details( 1234 );

		$response_data = [
			'status' => 200,
			'status_description' => 'Command completed successfully',
			'success' => true,
			'client_txn_id' => 'test-client-transaction-id',
			'server_txn_id' => '5ffdba44-eeec-4647-9cc4-27cdf8352efc.local-isolated-test-request',
			'timestamp' => 1669075517,
			'runtime' => 0.0019,
			'data' => [
				'event' => [
					'id' => 1234,
					'event_class' => 'Domain_Set_Contacts',
					'event_subclass' => 'Fail',
					'object_type' => 'domain',
					'object_id' => 'example.com',
					'event_date' => '2022-01-23 12:34:56',
					'acknowledged_date' => null,
					'event_data' => [
						// TODO: Provide accurate error data once this is finalized in the server repo
						'error' => [
							'class' => 'Entity',
							'subclass' => 'Invalid_Value',
							'data' =>
								[
									'invalid_option' => 'Automattic\\Domain_Services\\Command\\Domain\\Contacts\\Contacts',
									'reason' => 'Missing country code.',
								],
						],
					],
				],
			],
		];

		/** @var Response\Event\Details $response_object */
		$response_object = $this->response_factory->build_response( $command, $response_data );

		$this->assertIsValidResponse( $response_data, $response_object );

		$event = $response_object->get_event();
		$this->assertNotNull( $event );

		$this->assertInstanceOf( Event\Domain\Set\Contacts\Fail::class, $event );
		$this->assertSame( $response_data['data']['event']['object_id'], $event->get_domain()->get_name() );
		$this->assertSame( $response_data['data']['event']['event_data']['error']['data']['reason'], $event->get_error_reason() );
	}
}