<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Tests\Unit\Traits;

use IceHawk\PubSub\Tests\Unit\Fixtures\StringValueObject;

class StringRepresentingTest extends \PHPUnit_Framework_TestCase
{
    public function testCanGetObjectAsString()
    {
        $valueObject = new StringValueObject( 'Unit-Test' );

        $this->assertEquals( 'Unit-Test', $valueObject->toString() );
        $this->assertEquals( 'Unit-Test', (string)$valueObject );
        $this->assertEquals( 'Unit-Test', strval( $valueObject ) );
        $this->assertEquals( '"Unit-Test"', json_encode( $valueObject ) );
    }
}
