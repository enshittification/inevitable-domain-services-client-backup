<?php declare( strict_types=1 );

namespace Automattic\Domain_Services\Test\Entity;

use Automattic\Domain_Services\{Entity, Exception, Response, Test};

class Domain_Contacts_Test extends Test\Lib\Domain_Services_Client_Test_Case {
	private const CONTACT_TYPES = [
		'owner',
		'admin',
		'tech',
		'billing',
	];

	public function test_entity_instance_success(): void {
		$contact_information = [
			'first_name' => 'Domains',
			'last_name' => 'Developer',
			'organization' => 'Automattic',
			'address_1' => '60 29th Street',
			'address_2' => '#343',
			'postal_code' => '94110',
			'city' => 'San Francisco',
			'state' => 'CA',
			'country_code' => 'US',
			'email' => 'domains@example.com',
			'phone' => '+1.8772733049',
			'fax' => '+1.8881234567',
		];

		$entity = new Entity\Domain_Contacts();
		$array = [];
		foreach ( self::CONTACT_TYPES as $type ) {
			$array[ $type ] = [
				'contact_id' => null,
				'contact_information' => $contact_information,
				'contact_disclosure' => 'none',
			];

			$contact_information_entity = Entity\Contact_Information::from_array( $contact_information );
			$domain_contact = new Entity\Domain_Contact( null, $contact_information_entity );

			$entity->set_by_key( $type, $domain_contact );

			$this->assertSame( $domain_contact, $entity->get_by_key( $type ) );
			$this->assertSame( $contact_information_entity, $entity->get_by_key( $type )->get_contact_information() );
		}

		$this->assertArraysEqual( $array, $entity->to_array() );
	}

	public function test_entity_instance_from_array_success(): void {
		$contact_information = [
			'first_name' => 'Domains',
			'last_name' => 'Developer',
			'organization' => 'Automattic',
			'address_1' => '60 29th Street',
			'address_2' => '#343',
			'postal_code' => '94110',
			'city' => 'San Francisco',
			'state' => 'CA',
			'country_code' => 'US',
			'email' => 'domains@example.com',
			'phone' => '+1.8772733049',
			'fax' => '+1.8881234567',
		];

		$array = [];
		foreach ( self::CONTACT_TYPES as $type ) {
			$array[ $type ] = [
				'contact_id' => null,
				'contact_information' => $contact_information,
				'contact_disclosure' => 'none',
			];
		}

		// Adding to the array a contact with invalid type. It should be skipped without throwing errors
		$array['invalid-type'] = [ 'contact_id' => Entity\Domain_Contact::from_array( [ 'contact_id' => 'SP1:A-323444' ] ) ];

		$entity = Entity\Domain_Contacts::from_array( $array );

		foreach ( self::CONTACT_TYPES as $type ) {
			$domain_contact = $entity->get_by_key( $type );
			$this->assertInstanceOf( Entity\Domain_Contact::class, $entity->get_by_key( $type ) );
			$this->assertArraysEqual( $array[ $type ], $domain_contact->to_array() );
		}

		// Remove the invalid type again before comparing
		unset( $array['invalid-type'] );

		$this->assertArraysEqual( $array, $entity->to_array() );
	}

	public function test_entity_instance_fail(): void {
		$this->expectException( Exception\Entity\Invalid_Value_Exception::class );
		$this->expectExceptionCode( Response\Code::INVALID_ENTITY_VALUE );
		$this->expectExceptionMessage( Response\Code::get_description( Response\Code::INVALID_ENTITY_VALUE ) );

		$contact = Entity\Domain_Contact::from_array( [ 'contact_id' => 'SP1:A-323444' ] );
		$entity = new Entity\Domain_Contacts;

		$entity->set_by_key( 'invalid-type', $contact );
	}

}
