<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Interfaces;

/**
 * Interface IdentifiesThings
 * @package IceHawk\PubSub\Interfaces
 */
interface RepresentsValueAsString extends \JsonSerializable
{
    public function toString() : string;

    public function __toString() : string;
}
