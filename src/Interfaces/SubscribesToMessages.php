<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Interfaces;

/**
 * Interface SubscribesToMessages
 * @package IceHawk\PubSub\Interfaces
 */
interface SubscribesToMessages
{
    public function notify( CarriesInformation $message, IdentifiesChannel $channel );
}
