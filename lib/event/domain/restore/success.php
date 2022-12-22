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

namespace Automattic\Domain_Services\Event\Domain\Restore;

use Automattic\Domain_Services\{Entity, Event};

/**
 * Success event for a `Domain\Restore` command.
 *
 * This event is sent when a restore operation succeeds.
 *
 * @see \Automattic\Domain_Services\Command\Domain\Restore
 */
class Success implements Event\Event_Interface {
	use Event\Data_Trait;
	use Event\Object_Type_Domain_Trait;

	/**
	 * Gets the status of the domain immediately after the restore operation.
	 *
	 * @return string|null
	 */
	public function get_domain_status(): ?string {
		return $this->get_data_by_key( 'event_data.domain_status' );
	}

	/**
	 * Gets the expiration date of the domain after the restore operation.
	 *
	 * @return \DateTimeInterface|null
	 */
	public function get_expiration_date(): ?\DateTimeInterface {
		$expiration_date = $this->get_data_by_key( 'event_data.expiration_date' );
		return null === $expiration_date ? null : \DateTimeImmutable::createFromFormat( Entity\Entity_Interface::DATE_FORMAT, $expiration_date );
	}

	/**
	 * Gets the renewal date of the domain after the restore operation.
	 *
	 * @return \DateTimeInterface|null
	 */
	public function get_renewal_date(): ?\DateTimeInterface {
		$renewal_date = $this->get_data_by_key( 'event_data.renewal_date' );
		return null === $renewal_date ? null : \DateTimeImmutable::createFromFormat( Entity\Entity_Interface::DATE_FORMAT, $renewal_date );
	}
}
