<?php declare( strict_types=1 );

namespace Automattic\Domain_Services\Test\Command;

use Automattic\Domain_Services\{Command, Entity, Test};

class Domain_Contacts_Set_Test extends Test\Lib\Domain_Services_Client_Test_Case {
	use Command\Array_Key_Domain_Trait, Command\Array_Key_Contacts_Trait, Command\Array_Key_Contact_Information_Trait, Command\Array_Key_Contact_Id_Trait, Command\Array_Key_Contact_Disclosure_Trait;

	public function test_command_instance_success(): void {
		$mock_command_data = [
			Command\Command_Interface::COMMAND => 'Domain_Contacts_Set',
			Command\Command_Interface::PARAMS => [
				self::get_domain_name_array_key() => 'test-domain-name.com',
				self::get_contacts_array_key() => [
					'owner' => [
						self::get_contact_id_array_key() => null,
						self::get_contact_information_array_key() => [
							'first_name' => 'John',
							'last_name' => 'Doe',
							'organization' => '',
							'address_1' => '60 29th Street #343',
							'address_2' => '',
							'postal_code' => '94110',
							'city' => 'San Francisco',
							'state' => 'CA',
							'country_code' => 'US',
							'email' => 'registrar@automattic.com',
							'phone' => '+1.8772733049',
							'fax' => '',
						],
						self::get_contact_disclosure_array_key() => Entity\Contact_Disclosure::NONE,
					],
				],
			],
			Command\Command_Interface::CLIENT_TXN_ID => 'client-transaction-info-for-dns-records-get-test-1',
		];

		$domain = new Entity\Domain_Name( $mock_command_data[ Command\Command_Interface::PARAMS ][ self::get_domain_name_array_key() ] );
		$contacts = Entity\Domain_Contacts::from_array( $mock_command_data[ Command\Command_Interface::PARAMS ][ self::get_contacts_array_key() ] );
		$command = new Command\Domain\Contacts\Set( $domain, $contacts );
		$command->set_client_txn_id( $mock_command_data[ Command\Command_Interface::CLIENT_TXN_ID ] );

		$this->assertInstanceOf( Command\Domain\Contacts\Set::class, $command );

		$actual_command_array = $command->jsonSerialize();

		$this->assertSame( $mock_command_data, $actual_command_array );
	}
}