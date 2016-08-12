<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace IceHawk\PubSub\Interfaces;

/**
 * Interface CarriesInformation
 * @package IceHawk\PubSub\Interfaces
 */
interface CarriesInformation
{
	public function getMessageId() : IdentifiesMessage;

	public function getMessageName() : NamesMessage;
}
