<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub;

use IceHawk\PubSub\Interfaces\CarriesInformation;
use IceHawk\PubSub\Interfaces\SubscribesToMessages;

/**
 * Class AbstractMessageSubscriber
 * @package IceHawk\PubSub
 */
abstract class AbstractMessageSubscriber implements SubscribesToMessages
{
	final public function notify( CarriesInformation $message )
	{
		$methodName = 'on' . $message->getChannel();

		if ( method_exists( $this, $methodName ) )
		{
			call_user_func( [ $this, $methodName ], $message );
		}
	}
}