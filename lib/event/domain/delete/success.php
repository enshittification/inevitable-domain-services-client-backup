<?php declare( strict_types=1 );

namespace Automattic\Domain_Services\Event\Domain\Delete;

use Automattic\Domain_Services\{Event};

class Success implements Event\Event_Interface {
	use Event\Data_Trait;
}