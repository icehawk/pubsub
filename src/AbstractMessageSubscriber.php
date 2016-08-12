<?php declare(strict_types = 1);
/**
 * @author hollodotme
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

        if ( is_callable( [ $this, $methodName ] ) )
        {
            call_user_func( [ $this, $methodName ], $message, $channel );
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
            preg_replace( [ '#[^a-z]#i', '#_+#' ], '_', $messageName )
        );

        $methodName = 'when' . ucfirst( $channelName );

        return $methodName;
    }
}
