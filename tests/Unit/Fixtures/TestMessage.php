<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Tests\Unit\Fixtures;

use IceHawk\PubSub\Interfaces\CarriesInformation;
use IceHawk\PubSub\Interfaces\IdentifiesMessage;
use IceHawk\PubSub\Interfaces\NamesMessage;

/**
 * Class TestMessage
 * @package IceHawk\PubSub\Tests\Unit\Fixtures
 */
class TestMessage implements CarriesInformation
{
    /** @var IdentifiesMessage */
    private $messageId;

    /** @var NamesMessage */
    private $messageName;

    /** @var string */
    private $messageText;

    /**
     * @param IdentifiesMessage $messageId
     * @param NamesMessage      $messageName
     * @param string            $messageText
     */
    public function __construct(
        IdentifiesMessage $messageId,
        NamesMessage $messageName,
        $messageText
    )
    {
        $this->messageId   = $messageId;
        $this->messageName = $messageName;
        $this->messageText = $messageText;
    }

    public function getMessageId() : IdentifiesMessage
    {
        return $this->messageId;
    }

    public function getMessageName() : NamesMessage
    {
        return $this->messageName;
    }

    public function getMessageText() : string
    {
        return $this->messageText;
    }
}
