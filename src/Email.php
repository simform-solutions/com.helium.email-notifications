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

	public function setServerSettings()
	{
		return $this->_emailEngine->setServerSettings();
	}

	public function setHtmlEmail()
	{
		return $this->_emailEngine->setHtmlEmail();
	}

	public function setTextEmail()
	{
		return $this->_emailEngine->setTextEmail();
	}

	public function setFromAddress($address, $name = null)
	{
		return $this->_emailEngine->setFromAddress($address, $name);
	}

	public function setRecipients($address, $name = null)
	{
		return $this->_emailEngine->setRecipients($address, $name);
	}

	public function setBCC($address, $name = null)
	{
		return $this->_emailEngine->setBCC($address, $name);
	}

	public function setCC($address, $name = null)
	{
		return $this->_emailEngine->setCC($address, $name);
	}

	public function setAttachment($attachment, $name = null)
	{
		return $this->_emailEngine->setAttachment($attachment, $name);
	}

	public function setSubject($subject)
	{
		return $this->_emailEngine->setSubject($subject);
	}

	public function setBody($body)
	{
		return $this->_emailEngine->setBody($body);
	}

	public function setAltBody($altBody)
	{
		return $this->_emailEngine->setAltBody($altBody);
	}

	public function setCustomHeader($header, $value)
	{
		return $this->_emailEngine->setCustomHeader($header, $value);
	}
}