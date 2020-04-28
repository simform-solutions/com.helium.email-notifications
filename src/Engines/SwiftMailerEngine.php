<?php
/**
 * Created by PhpStorm.
 * User: spencermerryman
 * Date: 2020-02-11
 * Time: 11:53
 */

namespace Helium\EmailNotifications\Engines;

use Helium\EmailNotifications\Contracts\EmailNotificationInterface;
use Swift_Attachment;
use Swift_Mailer;
use Swift_SmtpTransport;
use Swift_Message;


class SwiftMailerEngine implements EmailNotificationInterface
{

	private $_swiftMessage = null;
	private $_swiftTransport = null;

	public function __construct()
	{
		$this->_swiftMessage = new Swift_Message();
	}

	public function sendEmail(): void
	{
		$mailer = new Swift_Mailer($this->_swiftTransport);
		return $mailer->send($this->_swiftMessage);
	}

	public function setServerSettings(array $serverSettings): EmailNotificationInterface
	{
		$this->_swiftTransport = (new Swift_SmtpTransport($serverSettings['mail_host'], $serverSettings['mail_port']))
			->setUsername($serverSettings['mail_username'])
			->setPassword($serverSettings['mail_password']);

		return $this;
	}

	public function setFromAddress(string $address,
		string $name = null): EmailNotificationInterface
	{
		if ($name) {
			$this->_swiftMessage->setFrom([$address => $name]);
		} else {
			$this->_swiftMessage->setFrom($address);
		}

		return $this;
	}

	public function addRecipient(string $address,
		string $name = null): EmailNotificationInterface
	{
		$this->_swiftMessage->addTo($address, $name);

		return $this;
	}

	public function addCc(string $address,
		string $name = null): EmailNotificationInterface
	{
		$this->_swiftMessage->addCc($address, $name);

		return $this;
	}

	public function addBcc(string $address,
		string $name = null): EmailNotificationInterface
	{
		$this->_swiftMessage->addBcc($address, $name);

		return $this;
	}

	public function addAttachment($attachment,
		string $name = null): EmailNotificationInterface
	{
		if ($name) {
			$this->_swiftMessage->attach(Swift_Attachment::fromPath($attachment)->setFilename($name));
		} else {
			$this->_swiftMessage->attach(Swift_Attachment::fromPath($attachment));
		}

		return $this;
	}

	public function setSubject(string $subject): EmailNotificationInterface
	{
		$this->_swiftMessage->setSubject($subject);

		return $this;
	}

	public function setBody(string $body): EmailNotificationInterface
	{
		$this->_swiftMessage->addPart($body, 'text/html');

		return $this;
	}

	public function setAltBody(string $altBody): EmailNotificationInterface
	{
		$this->_swiftMessage->setBody($altBody);

		return $this;
	}

	public function setCustomHeader(string $header,
		string $value): EmailNotificationInterface
	{
		$headers = $this->_swiftMessage->getHeaders();
		$headers->addTextHeader($header, $value);

		return $this;
	}

}