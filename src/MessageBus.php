<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub;

use IceHawk\PubSub\Interfaces\CarriesInformation;
use IceHawk\PubSub\Interfaces\DispatchesMessages;
use IceHawk\PubSub\Interfaces\IdentifiesChannel;
use IceHawk\PubSub\Interfaces\SubscribesToChannel;

/**
 * Class MessageBus
 * @package IceHawk\PubSub
 */
final class MessageBus implements DispatchesMessages
{
	/** @var array|SubscribesToChannel[][] */
	private $subscriptions;

	public function __construct()
	{
		$this->subscriptions = [ ];
	}

	public function publish( CarriesInformation $message )
	{
		$subscribers = $this->getSubscribersForChannel( $message->getChannel() );

		/** @var SubscribesToChannel $subscriber */
		foreach ( $subscribers as $subscriber )
		{
			$subscriber->notify( $message );
		}
	}

	/**
	 * @param IdentifiesChannel $channel
	 *
	 * @return array|SubscribesToChannel[]
	 */
	private function getSubscribersForChannel( IdentifiesChannel $channel ) : array
	{
		return $this->subscriptions[ $channel->toString() ] ?? [ ];
	}

	public function subscribe( IdentifiesChannel $channel, SubscribesToChannel $subscriber )
	{
		$key = $channel->toString();

		if ( isset($this->subscriptions[ $key ]) )
		{
			if ( !in_array( $subscriber, $this->subscriptions[ $key ], true ) )
			{
				$this->subscriptions[ $key ][] = $subscriber;
			}
		}
		else
		{
			$this->subscriptions[ $key ] = [ $subscriber ];
		}
	}
}