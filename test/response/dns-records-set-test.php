<?php declare( strict_types=1 );

namespace Automattic\Domain_Services\Test\Response;

use Automattic\Domain_Services\{Command, Entity, Response, Test};

class Dns_Records_Set_Test extends Test\Lib\Domain_Services_Client_Test_Case {
	public function test_response_factory_success(): void {
		$domain = new Entity\Domain_Name( 'dns-records-set-test-domain.blog' );
		$dns_record_sets = Entity\Dns_Record_Sets::from_array(
			[
				[
					'name' => '@',
					'type' => 'A',
					'ttl' => 3600,
					'data' => [
						'9.10.11.12',
						'13.14.15.16',
					],
				],
				[
					'name' => '@',
					'type' => 'TXT',
					'ttl' => 3600,
					'data' => [
						'Hi! I am TXT record!',
					],
				],
			],
		);
		$dns_records = new Entity\Dns_Records( $domain, $dns_record_sets );
		$command = new Command\Dns\Records\Set( $dns_records );

		$response_data = Test\Lib\Mock\get_mock_response( $command, $domain->get_name(), 'success' );

		/** @var Response\Dns\Records\Set $response_object */
		$response_object = $this->response_factory->build_response( $command, $response_data );

		$this->assertInstanceOf( Response\Dns\Records\Set::class, $response_object );

		$response_dns_records_added = $response_object->get_records_added();
		$response_dns_records_deleted = $response_object->get_records_deleted();

		$response_domain_name_for_added_records = $response_dns_records_added->get_domain();
		$response_domain_name_for_deleted_records = $response_dns_records_deleted->get_domain();
		$this->assertSame( $domain->get_name(), $response_domain_name_for_added_records->get_name() );
		$this->assertSame( $domain->get_name(), $response_domain_name_for_deleted_records->get_name() );

		$response_dns_added_record_sets = $response_dns_records_added->get_record_sets();
		$response_dns_added_record_sets_data = $response_dns_added_record_sets->to_array();
		$this->assertIsArray( $response_dns_added_record_sets_data );
		$this->assertCount( 1, $response_dns_added_record_sets_data );

		$response_dns_deleted_record_sets = $response_dns_records_deleted->get_record_sets();
		$response_dns_deleted_record_sets_data = $response_dns_deleted_record_sets->to_array();
		$this->assertIsArray( $response_dns_deleted_record_sets_data );
		$this->assertCount( 2, $response_dns_deleted_record_sets_data );
	}
}
