<?php
/**
 * Created by PhpStorm.
 * User: spencermerryman
 * Date: 2020-02-11
 * Time: 10:04
 */

namespace Helium\EmailNotifications;


class Email implements EmailNotificationInterface
{

	private $_emailEngine = null;

	public function __construct(EmailNotificationInterface $object)
	{
		$this->_emailEngine = $object;
	}

	public function sendEmail()
	{
		return $this->_emailEngine->sendEmail();
	}

	public function setServerSettings(array $serverSettings)
	{
		return $this->_emailEngine->setServerSettings($serverSettings);
	}

	public function setFromAddress(string $address, string $name = null)
	{
		return $this->_emailEngine->setFromAddress($address, $name);
	}

	public function setRecipients(string $address, string $name = null)
	{
		return $this->_emailEngine->setRecipients($address, $name);
	}

	public function setBCC(string $address, string $name = null)
	{
		return $this->_emailEngine->setBCC($address, $name);
	}

	public function setCC(string $address, string $name = null)
	{
		return $this->_emailEngine->setCC($address, $name);
	}

	public function setAttachment($attachment, string $name = null)
	{
		return $this->_emailEngine->setAttachment($attachment, $name);
	}

	public function setSubject(string $subject)
	{
		return $this->_emailEngine->setSubject($subject);
	}

	public function setBody(string $body)
	{
		return $this->_emailEngine->setBody($body);
	}

	public function setAltBody(string $altBody)
	{
		return $this->_emailEngine->setAltBody($altBody);
	}

	public function setCustomHeader(string $header, string $value)
	{
		return $this->_emailEngine->setCustomHeader($header, $value);
	}
}