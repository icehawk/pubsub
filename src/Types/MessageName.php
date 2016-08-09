<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Types;

use IceHawk\PubSub\Interfaces\NamesMessage;
use IceHawk\PubSub\Traits\StringRepresenting;

/**
 * Class MessageName
 * @package IceHawk\PubSub\Types
 */
final class MessageName implements NamesMessage
{
	use StringRepresenting;

	/** @var string */
	private $messageName;

	public function __construct( string $messageName )
	{
		$this->messageName = $messageName;
	}

	public function toString() : string
	{
		return $this->messageName;
	}
}