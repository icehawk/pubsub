[![Build Status](https://travis-ci.org/icehawk/pubsub.svg?branch=master)](https://travis-ci.org/icehawk/pubsub)
[![Coverage Status](https://coveralls.io/repos/github/icehawk/pubsub/badge.svg?branch=master)](https://coveralls.io/github/icehawk/pubsub?branch=master)
[![Latest Stable Version](https://poser.pugx.org/icehawk/pubsub/v/stable)](https://packagist.org/packages/icehawk/pubsub) 
[![Total Downloads](https://poser.pugx.org/icehawk/pubsub/downloads)](https://packagist.org/packages/icehawk/pubsub) 
[![Latest Unstable Version](https://poser.pugx.org/icehawk/pubsub/v/unstable)](https://packagist.org/packages/icehawk/pubsub) 
[![License](https://poser.pugx.org/icehawk/pubsub/license)](https://packagist.org/packages/icehawk/pubsub)

# IceHawk\PubSub

Publish subscribe component for IceHawk framework

## Usage

### Create a message

**Please note:** 

* Messages should always be immutable.
* Every message must have a:
  * Message ID
  * Message name
  * Channel

```php
<?php

namespace MyVendor\MyNamespace;

use IceHawk\PubSub\Interfaces\CarriesInformation;
use IceHawk\PubSub\Interfaces\IdentifiesChannel;
use IceHawk\PubSub\Interfaces\IdentifiesMessage;
use IceHawk\PubSub\Interfaces\NamesMessage;
use IceHawk\PubSub\Types\Channel;
use IceHawk\PubSub\Types\MessageId;
use IceHawk\PubSub\Types\MessageName;

final class MyMessage implements CarriesInformation
{
	/** @var MessageId */
	private $messageId;
	
	/** @var string */
	private $message;
	
	public function __construct(MessageId $messageId, string $message) 
	{
		$this->messageId = $messageId;
		$this->message = $message;
	}
	
	public function getMessageId() : IdentifiesMessage 
	{
		return $this->messageId;
	}
	
	public function getMessageName() : NamesMessage 
	{
        return new MessageName('Something happened');
	}
	
	public function getChannel() : IdentifiesChannel 
	{
		return new Channel('ListenToMe');
	}
	
	public function getMessage() : string
	{
		return $this->message;
	}
}
```

### Create a message subscriber

**Note:** The `AbstractChannelSubscriber` automatically converts the message name to a method name by prefixing `when` to the message name, that is converted to upper camel case.
In this example: Message name "Something happened" becomes method name "whenSomethingHappened".

As the call to the method is triggered by the abstract parent class, the method must at least have protected (or public) visibility. 
Private methods would not be callable, because they would be out of scope.

```php
<?php

namespace MyVendor\MyNamespace;

use IceHawk\PubSub\AbstractChannelSubscriber;

final class MyMessageSubscriber extends AbstractChannelSubscriber
{
	protected function whenSomethingHappened(MyMessage $myMessage)
	{
		echo $myMessage->getMessage();
	}
}
```

### Subscribe to messages

```php
<?php

namespace MyVendor\MyNamespace;

use IceHawk\PubSub\MessageBus;
use IceHawk\PubSub\Types\Channel;

// ...

$messageBus = new MessageBus();
$messageBus->subscribe(new Channel('ListenToMe'), new MyMessageSubscriber());

```

### Publish a message

```php
<?php

namespace MyVendor\MyNamespace;

use IceHawk\PubSub\Types\MessageId;

// ...

$message = new MyMessage(new MessageId('Identifier'), 'Hello World!');

$messageBus->publish($message);

```

**Prints:**

```
Hello World!
```