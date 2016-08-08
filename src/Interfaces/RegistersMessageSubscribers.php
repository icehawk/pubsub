<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Interfaces;

use IceHawk\PubSub\Types\Channel;

/**
 * Interface RegistersMessageSubscribers
 * @package IceHawk\PubSub\Interfaces
 */
interface RegistersMessageSubscribers
{
	public function subscribe( Channel $channel, SubscribesToMessages $subscriber );
}