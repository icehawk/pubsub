<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub;

use IceHawk\PubSub\Interfaces\CarriesInformation;
use IceHawk\PubSub\Interfaces\NamesMessage;
use IceHawk\PubSub\Interfaces\SubscribesToChannel;

/**
 * Class AbstractChannelSubscriber
 * @package IceHawk\PubSub
 */
abstract class AbstractChannelSubscriber implements SubscribesToChannel
{
	final public function notify( CarriesInformation $message )
	{
		$methodName = $this->getMethodName( $message->getMessageName() );

		if ( is_callable( [ $this, $methodName ] ) )
		{
			call_user_func( [ $this, $methodName ], $message );
		}
	}

	private function getMethodName( NamesMessage $messageName ) : string
	{
		$channelName = preg_replace_callback(
			"#_([a-z])#i",
			function ( array $matches ) : string
			{
				return strtoupper( $matches[1] );
			},
			preg_replace( [ '#[^a-z]#i', '#_+#' ], '_', $messageName->toString() )
		);

		$methodName = 'when' . ucfirst( $channelName );

		return $methodName;
	}
}