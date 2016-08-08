<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub;

use IceHawk\PubSub\Interfaces\CarriesInformation;
use IceHawk\PubSub\Interfaces\DispatchesMessages;
use IceHawk\PubSub\Interfaces\SubscribesToMessages;
use IceHawk\PubSub\Types\Channel;

/**
 * Class MessageBus
 * @package IceHawk\PubSub
 */
final class MessageBus implements DispatchesMessages
{
	/** @var array|SubscribesToMessages[][] */
	private $subscriptions;

	public function __construct()
	{
		$this->subscriptions = [ ];
	}

	public function publish( CarriesInformation $message )
	{
		$subscribers = $this->getSubscribersForChannel( $message->getChannel() );

		/** @var SubscribesToMessages $subscriber */
		foreach ( $subscribers as $subscriber )
		{
			$subscriber->notify( $message );
		}
	}

	/**
	 * @param Channel $channel
	 *
	 * @return array|SubscribesToMessages[]
	 */
	private function getSubscribersForChannel( Channel $channel ) : array
	{
		$subscribers = [ ];

		foreach ( $this->subscriptions as $subscriptionChannel => $msgSubscribers )
		{
			if ( $channel->equalsString( $subscriptionChannel ) )
			{
				$subscribers = array_merge( $subscribers, $msgSubscribers );
			}
		}

		return $subscribers;
	}

	public function subscribe( Channel $channel, SubscribesToMessages $subscriber )
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