<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Tests\Unit\Fixtures;

use IceHawk\PubSub\AbstractMessageSubscriber;
use IceHawk\PubSub\Types\Channel;

/**
 * Class TestMessageSubscriber
 * @package IceHawk\PubSub\Tests\Unit\Fixtures
 */
class TestMessageSubscriber extends AbstractMessageSubscriber
{
    protected function whenTestMessageWasPublished( TestMessage $message, Channel $channel )
    {
        echo sprintf(
            'Message named "%s" with ID "%s" was published on channel "%s" with text "%s"',
            $message->getMessageName(),
            $message->getMessageId(),
            $channel,
            $message->getMessageText()
        );
    }
}
