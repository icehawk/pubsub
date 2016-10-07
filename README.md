[![Join the chat at https://gitter.im/icehawk/pubsub](https://badges.gitter.im/icehawk/pubsub.svg)](https://gitter.im/icehawk/pubsub?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Build Status](https://travis-ci.org/icehawk/pubsub.svg?branch=master)](https://travis-ci.org/icehawk/pubsub)
[![Coverage Status](https://coveralls.io/repos/github/icehawk/pubsub/badge.svg?branch=master)](https://coveralls.io/github/icehawk/pubsub?branch=master)
[![Latest Stable Version](https://poser.pugx.org/icehawk/pubsub/v/stable)](https://packagist.org/packages/icehawk/pubsub) 
[![Total Downloads](https://poser.pugx.org/icehawk/pubsub/downloads)](https://packagist.org/packages/icehawk/pubsub) 
[![Latest Unstable Version](https://poser.pugx.org/icehawk/pubsub/v/unstable)](https://packagist.org/packages/icehawk/pubsub) 
[![License](https://poser.pugx.org/icehawk/pubsub/license)](https://packagist.org/packages/icehawk/pubsub)

# ![IceHawk Framework](https://icehawk.github.io/images/Logo-Flying-Tail-White.png)

# IceHawk\PubSub

Publish-Subscribe component for the [IceHawk](https://github.com/icehawk/icehawk) framework.

## Requirements

- PHP >= 7.0

## Installation

```
composer require "icehawk/pubsub:^1.0"
```

## Usage

### Create a message

**Please note:** 

* Messages should always be immutable.
* Every message MUST have a:
  * Message ID
  * Message name
  
... and of course user-defined content, so called payload. 

IceHawk/PubSub shipps with 2 types/value objects for the message ID and message name.
If you don't want / can't use them for any reason, you can alternativly implement their interfaces.
 
| Shipped type / value object          | Interface                                     |
|--------------------------------------|-----------------------------------------------|
| `IceHawk\PubSub\Types\MessageId`     | `IceHawk\PubSub\Interfaces\IdentifiesMessage` |
| `IceHawk\PubSub\Types\MessageName`   | `IceHawk\PubSub\Interfaces\NamesMessage`      |

The message itself MUST implement the following interface:

`IceHawk\PubSub\Interfaces\CarriesInformation`

So a message implementation could look like this:

```php
<?php

namespace MyVendor\MyNamespace;

use IceHawk\PubSub\Interfaces\CarriesInformation;
use IceHawk\PubSub\Interfaces\IdentifiesMessage;
use IceHawk\PubSub\Interfaces\NamesMessage;

final class MyMessage implements CarriesInformation
{
	/** @var IdentifiesMessage */
	private $messageId;
	
	/** @var NamesMessage */
	private $messageName;
	
	/** @var string */
	private $content;
	
	public function __construct( IdentifiesMessage $messageId, NamesMessage $messageName, string $content ) 
	{
		$this->messageId    = $messageId;
		$this->messageName  = $messageName;
		$this->content      = $content;
	}
	
	public function getMessageId() : IdentifiesMessage 
	{
		return $this->messageId;
	}
	
	public function getMessageName() : NamesMessage 
	{
        return $this->messageName;
	}
	
	public function getContent() : string
	{
		return $this->content;
	}
}
```

And a new instance of this message is created like this:

```php
<?php

namespace MyVendor\MyNamespace;

use IceHawk\PubSub\Types\MessageId;
use IceHawk\PubSub\Types\MessageName;

$myMessage = new MyMessage( 
    new MessageId( '123456-ABC-789' ),
    new MessageName( 'Something had happened' ),
    'Hello World!' 
);
```

### Create a message subscriber

To implement a subscriber that gets notified about all messages published to the channel it is subscribing to, 
you can extend the `AbstractMessageSubscriber` class that is shipped with IceHawk\PubSub.

The `AbstractMessageSubscriber` class automatically converts the message name to a handler method name by prefixing `when` to the message name, 
which is converted to upper camelcase. (All non-alphanumeric characters are removed.)
In this example: The message name "Something had happened" becomes the handler method name "whenSomethingHadHappened".

As the invocation to the handler method is triggered by the abstract parent class, the method must at least have protected (or public) visibility. 
Private methods would not be callable, because they would be out of the parent class' scope.

The handler methods gets invoked with 2 parameters:

1. The published message instance
2. The channel instance the message was published on

IceHawk\PubSub shipps with a type/value object for channels.
If you don't want / can't use it for any reason, you can alternativly implement its interfaces.
 
| Shipped type / value object          | Interface                                     |
|--------------------------------------|-----------------------------------------------|
| `IceHawk\PubSub\Types\Channel`       | `IceHawk\PubSub\Interfaces\IdentifiesChannel` |

The alternative to extend the `AbstractMessageSubscriber` class is to implement the following interface:

`IceHawk\PubSub\Interfaces\SubscribesToMessages`

A basic implementation of a subscriber, being notified about the previously created message, could look like this:

```php
<?php

namespace MyVendor\MyNamespace;

use IceHawk\PubSub\AbstractMessageSubscriber;
use IceHawk\PubSub\Types\Channel;

final class MySubscriber extends AbstractMessageSubscriber
{
	protected function whenSomethingHadHappened( MyMessage $myMessage, Channel $channel )
	{
		printf(
		    'Message named "%s" with ID "%s" was published on channel "%" with content: "%s"',
		    $myMessage->getMessageName(),
		    $myMessage->getMessageId(),
		    $channel,
		    $myMessage->getContent()
		);
	}
}
```

### Subscribe to a channel

```php
<?php

namespace MyVendor\MyNamespace;

use IceHawk\PubSub\MessageBus;
use IceHawk\PubSub\Types\Channel;

// ...

$messageBus = new MessageBus();
$messageBus->subscribe( new Channel( 'ListenToMe' ), new MySubscriber() );

```

**Note:** The `MessageBus` class automatically prevents subscribing of equal subscribers to the same channel. 
But one subscriber can subscribe to multiple channels.

### Publish a message

In the same way you subscribe to a channel, you will publish a message to a channel like this:

```php
<?php

namespace MyVendor\MyNamespace;

use IceHawk\PubSub\Types\Channel;

// ...

$messageBus->publish( new Channel('ListenToMe'), $message );

```

**Prints:**

```
Message named "Something had happened" with ID "123456-ABC-789" was published on channel "ListenToMe" with content: "Hello World!"'
```
