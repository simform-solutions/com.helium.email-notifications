<?php

namespace Helium\EmailNotifications;

use Helium\EmailNotifications\Contracts\EmailNotificationInterface;
use Helium\EmailNotifications\Engines\PhpMailerEngine;
use Helium\EmailNotifications\Engines\SwiftMailerEngine;
use Helium\ServiceManager\ServiceManager;

/**
 * @mixin EmailNotificationInterface
 */
class EmailNotification extends ServiceManager
{
	public static function create(): ServiceManager
	{
		$manager = new EmailNotification('phpMailer');

		$manager->extend('phpMailer', new PhpMailerEngine(false));

		$manager->extend('swiftMailer', new SwiftMailerEngine());

		return $manager;
	}

	public function sendEmail(): void
	{
		$this->engine()->sendEmail();
	}

	public function setServerSettings(array $serverSettings): EmailNotificationInterface
	{
		return $this->engine()->setServerSettings($serverSettings);
	}

	public function setFromAddress(string $address, string $name = null): EmailNotificationInterface
	{
		return $this->engine()->setFromAddress($address, $name);
	}

	public function addRecipient(string $address, string $name = null): EmailNotificationInterface
	{
		return $this->engine()->addRecipient($address, $name);
	}

	public function addBcc(string $address, string $name = null): EmailNotificationInterface
	{
		return $this->engine()->addBcc($address, $name);
	}

	public function addCc(string $address, string $name = null): EmailNotificationInterface
	{
		return $this->engine()->addCc($address, $name);
	}

	public function addAttachment(string $path, string $name = null): EmailNotificationInterface
	{
		return $this->engine()->addAttachment($path, $name);
	}

	public function setSubject(string $subject): EmailNotificationInterface
	{
		return $this->engine()->setSubject($subject);
	}

	public function setBody(string $body): EmailNotificationInterface
	{
		return $this->engine()->setBody($body);
	}

	public function setAltBody(string $altBody): EmailNotificationInterface
	{
		return $this->engine()->setAltbody($altBody);
	}

	public function setCustomHeader(string $header, string $value): EmailNotificationInterface
	{
		return $this->engine()->setCustomHeader($header, $value);
	}
}