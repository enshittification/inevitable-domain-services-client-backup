<?php declare( strict_types=1 );

namespace Automattic\Domain_Services\Event\Domain\Transfer\Out;

use Automattic\Domain_Services\{Event};

class Pending implements Event\Event_Interface {
	use Event\Data_Trait;
}