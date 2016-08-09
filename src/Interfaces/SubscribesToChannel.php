<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Interfaces;

/**
 * Interface SubscribesToChannel
 * @package IceHawk\PubSub\Interfaces
 */
interface SubscribesToChannel
{
	public function notify( CarriesInformation $message );
}