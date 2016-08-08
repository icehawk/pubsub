<?php
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Traits;

/**
 * Trait Scalarizing
 * @package IceHawk\PubSub\Traits
 */
trait Scalarizing
{
	abstract public function toString() : string;

	public function __toString() : string
	{
		return $this->toString();
	}

	public function jsonSerialize()
	{
		return $this->toString();
	}
}