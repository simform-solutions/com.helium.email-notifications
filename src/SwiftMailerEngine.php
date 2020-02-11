<?php
/**
 * Created by PhpStorm.
 * User: spencermerryman
 * Date: 2020-02-11
 * Time: 11:53
 */

namespace Helium\EmailNotifications;

use Swift_Attachment;
use Swift_Mailer;
use Swift_SmtpTransport;
use Swift_Message;


class SwiftMailerEngine implements EmailNotificationInterface
{

	private $_swiftMailer = null;
	private $_swiftMessage = null;
	private $_swiftTransport = null;

	public function __construct(array $serverSettings)
	{
		$this->_swiftTransport = $this->setServerSettings($serverSettings);
		$this->_swiftMailer = new Swift_Mailer($this->_swiftTransport);
		$this->_swiftMessage = new Swift_Message();
	}

	public function sendEmail()
	{
		return $this->_swiftMailer->send($this->_swiftMessage);
	}

	public function setServerSettings(array $serverSettings)
	{
		return (new Swift_SmtpTransport($serverSettings['mail_host'], $serverSettings['mail_port']))
						->setUsername($serverSettings['mail_username'])
						->setPassword($serverSettings['mail_password']);
	}

	public function setHtmlEmail()
	{
		// TODO: Implement setHtmlEmail() method.
	}

	public function setTextEmail()
	{
		// TODO: Implement setTextEmail() method.
	}

	public function setFromAddress(string $address, string $name = null)
	{
		if($name){
			return $this->_swiftMessage->setFrom([$address => $name]);
		} else {
			return $this->_swiftMessage->setFrom($address);
		}

	}

	public function setRecipients(string $address, string $name = null)
	{
		return $this->_swiftMessage->addTo($address, $name);
	}

	public function setCC(string $address, string $name = null)
	{
		return $this->_swiftMessage->addCc($address, $name);
	}

	public function setBCC(string $address, string $name = null)
	{
		return $this->_swiftMessage->addBcc($address, $name);
	}

	public function setAttachment($attachment, string $name = null)
	{
		if($name){
			return $this->_swiftMessage->attach(Swift_Attachment::fromPath($attachment)->setFilename($name));
		} else {
			return $this->_swiftMessage->attach(Swift_Attachment::fromPath($attachment));
		}
	}

	public function setSubject(string $subject)
	{
		return $this->_swiftMessage->setSubject($subject);
	}

	public function setBody(string $body)
	{
		return $this->_swiftMessage->setBody($body);
	}

	public function setAltBody(string $altBody)
	{
		// TODO: Implement setAltBody() method.
	}

	public function setCustomHeader(string $header, string $value)
	{
		// TODO: Implement setCustomHeader() method.
	}

}