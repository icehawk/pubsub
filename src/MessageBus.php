<?php declare(strict_types = 1);
/**
 * Copyright (c) 2016 Holger Woltersdorf & Contributors
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 */

namespace IceHawk\PubSub;

use IceHawk\PubSub\Interfaces\CarriesInformation;
use IceHawk\PubSub\Interfaces\DispatchesMessages;
use IceHawk\PubSub\Interfaces\IdentifiesChannel;
use IceHawk\PubSub\Interfaces\SubscribesToMessages;

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
		$this->subscriptions = [];
	}

	public function publish( IdentifiesChannel $channel, CarriesInformation $message )
	{
		$subscribers = $this->getSubscribersForChannel( $channel );

		/** @var SubscribesToMessages $subscriber */
		foreach ( $subscribers as $subscriber )
		{
			$subscriber->notify( $message, $channel );
		}
	}

	/**
	 * @param IdentifiesChannel $channel
	 *
	 * @return array|SubscribesToMessages[]
	 */
	private function getSubscribersForChannel( IdentifiesChannel $channel ) : array
	{
		return $this->subscriptions[ $channel->toString() ] ?? [];
	}

	public function subscribe( IdentifiesChannel $channel, SubscribesToMessages $subscriber )
	{
		$key = $channel->toString();

		if ( isset($this->subscriptions[ $key ]) )
		{
			if ( !in_array( $subscriber, $this->subscriptions[ $key ] ) )
			{
				$this->subscriptions[ $key ][] = $subscriber;
			}
		}
		else
		{
			$this->subscriptions[ $key ] = [$subscriber];
		}
	}
}
