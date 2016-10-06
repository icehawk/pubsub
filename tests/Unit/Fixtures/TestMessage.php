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
