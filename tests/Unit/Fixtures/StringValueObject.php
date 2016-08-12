<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Tests\Unit\Fixtures;

use IceHawk\PubSub\Interfaces\RepresentsValueAsString;
use IceHawk\PubSub\Traits\StringRepresenting;

/**
 * Class StringValueObject
 * @package IceHawk\PubSub\Tests\Unit\Fixtures
 */
final class StringValueObject implements RepresentsValueAsString
{
    use StringRepresenting;

    /** @var string */
    private $value;

    public function __construct( string $value )
    {
        $this->value = $value;
    }

    public function toString() : string
    {
        return $this->value;
    }
}
