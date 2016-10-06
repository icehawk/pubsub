<?php declare(strict_types = 1);
/**
 * Copyright (c) 2016 Holger Woltersdorf & Contributors
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 */

namespace IceHawk\PubSub\Tests\Unit;

use IceHawk\PubSub\MessageBus;
use IceHawk\PubSub\Tests\Unit\Fixtures\TestMessage;
use IceHawk\PubSub\Tests\Unit\Fixtures\TestMessageSubscriber;
use IceHawk\PubSub\Types\Channel;
use IceHawk\PubSub\Types\MessageId;
use IceHawk\PubSub\Types\MessageName;

class MessageBusTest extends \PHPUnit_Framework_TestCase
{
    public function testCanPublishMessages()
    {
        $messageBus            = new MessageBus();
        $testChannelSubscriber = new TestMessageSubscriber();

        $messageId   = new MessageId( 'Unit-Test-ID' );
        $messageName = new MessageName( 'Test message was published' );
        $channel     = new Channel( 'UnitTestChannel' );
        $testMessage = new TestMessage( $messageId, $messageName, 'Can publish messages' );

        $messageBus->subscribe( $channel, $testChannelSubscriber );

        $this->expectOutputString(
            'Message named "Test message was published" with ID "Unit-Test-ID" was published on '
            . 'channel "UnitTestChannel" with text "Can publish messages"'
        );

        $messageBus->publish( $channel, $testMessage );
    }

    public function testSubscribersWereAddedOnlyOnceForChannel()
    {
        $messageBus             = new MessageBus();
        $testChannelSubscriber1 = new TestMessageSubscriber();
        $testChannelSubscriber2 = new TestMessageSubscriber();

        $messageId   = new MessageId( 'Unit-Test-ID' );
        $messageName = new MessageName( 'Test message was published' );
        $channel     = new Channel( 'UnitTestChannel' );
        $testMessage = new TestMessage( $messageId, $messageName, 'Can add only one subscriber for channel' );

        $messageBus->subscribe( $channel, $testChannelSubscriber1 );
        $messageBus->subscribe( $channel, $testChannelSubscriber2 );

        $this->expectOutputString(
            'Message named "Test message was published" with ID "Unit-Test-ID" was published on '
            . 'channel "UnitTestChannel" with text "Can add only one subscriber for channel"'
        );

        $messageBus->publish( $channel, $testMessage );
    }
}
