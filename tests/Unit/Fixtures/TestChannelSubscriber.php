<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Tests\Unit\Fixtures;

use IceHawk\PubSub\AbstractChannelSubscriber;

/**
 * Class TestChannelSubscriber
 * @package IceHawk\PubSub\Tests\Unit\Fixtures
 */
class TestChannelSubscriber extends AbstractChannelSubscriber
{
	protected function whenTestMessage( TestMessage $message )
	{
		echo $message->getMessageText();
	}
}