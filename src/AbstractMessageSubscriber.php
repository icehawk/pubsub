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
use IceHawk\PubSub\Interfaces\IdentifiesChannel;
use IceHawk\PubSub\Interfaces\NamesMessage;
use IceHawk\PubSub\Interfaces\SubscribesToMessages;

/**
 * Class AbstractMessageSubscriber
 * @package IceHawk\PubSub
 */
abstract class AbstractMessageSubscriber implements SubscribesToMessages
{
	final public function notify( CarriesInformation $message, IdentifiesChannel $channel )
	{
		$methodName = $this->getHandlerMethodName( $message->getMessageName() );

		if ( is_callable( [$this, $methodName] ) )
		{
			call_user_func( [$this, $methodName], $message, $channel );
		}
	}

	private function getHandlerMethodName( NamesMessage $messageName ) : string
	{
		$channelName = preg_replace_callback(
			"#_([a-z])#i",
			function ( array $matches ) : string
			{
				return strtoupper( $matches[1] );
			},
			preg_replace( ['#[^a-z]#i', '#_+#'], '_', $messageName )
		);

		$methodName = 'when' . ucfirst( $channelName );

		return $methodName;
	}
}
