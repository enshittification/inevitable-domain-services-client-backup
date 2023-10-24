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

namespace Automattic\Domain_Services_Client\Test\Command;

use Automattic\Domain_Services_Client\{Command, Entity, Test};

class Domain_Transferable_Test extends Test\Lib\Domain_Services_Client_Test_Case {

	public function test_command_instance_success(): void {
		$mock_command_data = [
			Command\Command_Interface::COMMAND => 'Domain\Transferable',
			Command\Command_Interface::PARAMS => [
				Command\Command_Interface::KEY_DOMAIN => 'test-domain-name.com',
				Command\Command_Interface::KEY_AUTH_CODE => 'test-auth-code',
			],
			Command\Command_Interface::CLIENT_TXN_ID => 'client-transaction-info-for-domain-transferable-test-1',
		];

		$domain = new Entity\Domain_Name( $mock_command_data[ Command\Command_Interface::PARAMS ][ Command\Command_Interface::KEY_DOMAIN ] );
		$auth_code = $mock_command_data[ Command\Command_Interface::PARAMS ][ Command\Command_Interface::KEY_AUTH_CODE ];

		$command = new Command\Domain\Transferable( $domain, $auth_code );
		$command->set_client_txn_id( $mock_command_data[ Command\Command_Interface::CLIENT_TXN_ID ] );

		$this->assertInstanceOf( Command\Domain\Transferable::class, $command );

		$actual_command_array = $command->jsonSerialize();

		$this->assertArraysEqual( $mock_command_data, $actual_command_array );
	}
}