[![Build Status](https://travis-ci.org/icehawk/pub-sub.svg?branch=master)](https://travis-ci.org/icehawk/pub-sub)
[![Coverage Status](https://coveralls.io/repos/github/icehawk/pub-sub/badge.svg?branch=master)](https://coveralls.io/github/icehawk/pub-sub?branch=master)
[![Latest Stable Version](https://poser.pugx.org/icehawk/pub-sub/v/stable)](https://packagist.org/packages/icehawk/pub-sub) 
[![Total Downloads](https://poser.pugx.org/icehawk/pub-sub/downloads)](https://packagist.org/packages/icehawk/pub-sub) 
[![Latest Unstable Version](https://poser.pugx.org/icehawk/pub-sub/v/unstable)](https://packagist.org/packages/icehawk/pub-sub) 
[![License](https://poser.pugx.org/icehawk/pub-sub/license)](https://packagist.org/packages/icehawk/pub-sub)

# IceHawk\PubSub

Publish subscribe component for IceHawk framework

## Usage

### Create a message

**Please note:** Messages should always be immutable.

```php
<?php

namespace MyVendor\MyNamespace;

use IceHawk\PubSub\Interfaces\CarriesInformation;
use IceHawk\PubSub\Types\Channel;
use IceHawk\PubSub\Types\MessageId;

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
	
	public function getMessageId() : MessageId 
	{
		return $this->messageId;
	}
	
	public function getChannel() : Channel 
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

```php
<?php

namespace MyVendor\MyNamespace;

use IceHawk\PubSub\AbstractMessageSubscriber;

final class MyMessageSubscriber extends AbstractMessageSubscriber
{
	protected function onMyMessage(MyMessage $myMessage)
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