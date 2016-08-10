<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Tests\Unit\Fixtures;

use IceHawk\PubSub\Interfaces\CarriesInformation;
use IceHawk\PubSub\Interfaces\IdentifiesChannel;
use IceHawk\PubSub\Interfaces\IdentifiesMessage;
use IceHawk\PubSub\Interfaces\NamesMessage;
use IceHawk\PubSub\Types\Channel;
use IceHawk\PubSub\Types\MessageId;
use IceHawk\PubSub\Types\MessageName;

/**
 * Class TestMessage
 * @package IceHawk\PubSub\Tests\Unit\Fixtures
 */
class TestMessage implements CarriesInformation
{
	/** @var string */
	private $messageText;

	public function __construct( string $messageText )
	{
		$this->messageText = $messageText;
	}

	public function getMessageId() : IdentifiesMessage
	{
		return new MessageId( 'unit-test-id' );
	}

	public function getMessageName() : NamesMessage
	{
		return new MessageName( 'TestMessage' );
	}

	public function getChannel() : IdentifiesChannel
	{
		return new Channel( 'unit-test' );
	}

	public function getMessageText() : string
	{
		return $this->messageText;
	}
}