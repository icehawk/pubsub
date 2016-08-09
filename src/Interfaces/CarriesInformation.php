<?php
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

	public function getChannel() : IdentifiesChannel;
}