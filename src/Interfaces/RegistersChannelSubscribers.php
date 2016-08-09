<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Interfaces;

/**
 * Interface RegistersChannelSubscribers
 * @package IceHawk\PubSub\Interfaces
 */
interface RegistersChannelSubscribers
{
	public function subscribe( IdentifiesChannel $channel, SubscribesToChannel $subscriber );
}