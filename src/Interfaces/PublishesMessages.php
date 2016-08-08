<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Interfaces;

/**
 * Interface PublishesMessages
 * @package IceHawk\PubSub\Interfaces
 */
interface PublishesMessages
{
	public function publish( CarriesInformation $message );
}