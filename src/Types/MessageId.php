<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Types;

use IceHawk\PubSub\Interfaces\RepresentsValueAsString;
use IceHawk\PubSub\Traits\Scalarizing;

/**
 * Class MessageId
 * @package IceHawk\PubSub\Types
 */
final class MessageId implements RepresentsValueAsString
{
	use Scalarizing;

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