<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Interfaces;

use IceHawk\PubSub\Types\Channel;
use IceHawk\PubSub\Types\MessageId;

/**
 * Interface CarriesInformation
 * @package IceHawk\PubSub\Interfaces
 */
interface CarriesInformation
{
	public function getMessageId() : MessageId;

	public function getChannel() : Channel;
}