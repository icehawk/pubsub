<?php declare(strict_types = 1);
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
    public function subscribe( IdentifiesChannel $channel, SubscribesToMessages $subscriber );
}
