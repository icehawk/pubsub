<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Tests\Unit;

use IceHawk\PubSub\MessageBus;
use IceHawk\PubSub\Tests\Unit\Fixtures\TestChannelSubscriber;
use IceHawk\PubSub\Tests\Unit\Fixtures\TestMessage;

class MessageBusTest extends \PHPUnit_Framework_TestCase
{
	public function testCanPublishMessages()
	{
		$messageBus            = new MessageBus();
		$testChannelSubscriber = new TestChannelSubscriber();
		$testMessage           = new TestMessage( 'Can publish messages' );

		$messageBus->subscribe( $testMessage->getChannel(), $testChannelSubscriber );

		$this->expectOutputString( 'Can publish messages' );

		$messageBus->publish( $testMessage );
	}

	public function testSubscribersWereAddedOnlyOnceForChannel()
	{
		$messageBus             = new MessageBus();
		$testChannelSubscriber1 = new TestChannelSubscriber();
		$testChannelSubscriber2 = new TestChannelSubscriber();
		$testMessage            = new TestMessage( 'Can add only one subscriber for channel' );

		$messageBus->subscribe( $testMessage->getChannel(), $testChannelSubscriber1 );
		$messageBus->subscribe( $testMessage->getChannel(), $testChannelSubscriber2 );

		$this->expectOutputString( 'Can add only one subscriber for channel' );

		$messageBus->publish( $testMessage );
	}
}
