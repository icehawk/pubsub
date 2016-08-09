<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Types;

use IceHawk\PubSub\Interfaces\IdentifiesChannel;
use IceHawk\PubSub\Traits\StringRepresenting;

/**
 * Class Channel
 * @package IceHawk\PubSub\Types
 */
final class Channel implements IdentifiesChannel
{
	use StringRepresenting;

	/** @var string */
	private $channel;

	public function __construct( string $channel )
	{
		$this->channel = $channel;
	}

	public function toString() : string
	{
		return $this->channel;
	}
}