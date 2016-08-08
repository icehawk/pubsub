<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Types;

use IceHawk\PubSub\Interfaces\RepresentsValueAsString;
use IceHawk\PubSub\Traits\Scalarizing;

/**
 * Class Channel
 * @package IceHawk\PubSub\Types
 */
final class Channel implements RepresentsValueAsString
{
	use Scalarizing;

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

	public function equalsString( string $other ) : bool
	{
		return ($other == $this->toString());
	}
}