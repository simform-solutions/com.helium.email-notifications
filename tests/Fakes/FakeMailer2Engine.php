<?php

namespace Helium\EmailNotifications\Tests\Fakes;

use Helium\EmailNotifications\Contracts\EmailNotificationInterface;

class FakeMailer2Engine implements EmailNotificationInterface
{
	public function sendEmail(): void
	{
		//
	}

	public function setServerSettings(array $serverSettings): EmailNotificationInterface
	{
		return $this;
	}

	public function setFromAddress(string $address, string $name = null): EmailNotificationInterface
	{
		return $this;
	}

	public function addRecipient(string $address, string $name = null): EmailNotificationInterface
	{
		return $this;
	}

	public function addBcc(string $address, string $name = null): EmailNotificationInterface
	{
		return $this;
	}

	public function addCc(string $address, string $name = null): EmailNotificationInterface
	{
		return $this;
	}

	public function addAttachment($path, string $name = null): EmailNotificationInterface
	{
		return $this;
	}

	public function setSubject(string $subject): EmailNotificationInterface
	{
		return $this;
	}

	public function setBody(string $body): EmailNotificationInterface
	{
		return $this;
	}

	public function setAltBody(string $altBody): EmailNotificationInterface
	{
		return $this;
	}

	public function setCustomHeader(string $header, string $value): EmailNotificationInterface
	{
		return $this;
	}
}