<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Types;

use IceHawk\PubSub\Interfaces\IdentifiesMessage;
use IceHawk\PubSub\Traits\StringRepresenting;

/**
 * Class MessageId
 * @package IceHawk\PubSub\Types
 */
final class MessageId implements IdentifiesMessage
{
	use StringRepresenting;

	/** @var string */
	private $messageId;

	public function __construct( string $messageId )
	{
		$this->messageId = $messageId;
	}

	public function toString() : string
	{
		return $this->messageId;
	}
}
