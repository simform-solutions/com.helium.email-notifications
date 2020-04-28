<?php
/**
 * Created by PhpStorm.
 * User: spencermerryman
 * Date: 2020-02-11
 * Time: 10:07
 */

namespace Helium\EmailNotifications\Engines;

use Helium\EmailNotifications\Contracts\EmailNotificationInterface;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


class PhpMailerEngine implements EmailNotificationInterface
{
	private $_phpMailer = null;

	public function __construct(bool $exceptions)
	{
		$this->_phpMailer = new PHPMailer($exceptions);
	}

	public function setServerSettings(
		array $serverSettings): EmailNotificationInterface
	{
		$this->_phpMailer->isSMTP();
		$this->_phpMailer->Host = $serverSettings['mail_host'];
		$this->_phpMailer->Username = $serverSettings['mail_username'];
		$this->_phpMailer->Password = $serverSettings['mail_password'];
		$this->_phpMailer->Port = $serverSettings['mail_port'];
		$this->_phpMailer->SMTPAuth = (!isset($serverSettings['mail_auth']) || $serverSettings['mail_auth']) ? true : false;
		$this->_phpMailer->SMTPDebug = 2;

		return $this;
	}

	public function sendEmail(): void
	{
		$this->_phpMailer->send();
	}

	public function setFromAddress(string $address,
		string $name = null): EmailNotificationInterface
	{
		$this->_phpMailer->setFrom($address, $name);

		return $this;
	}

	public function addRecipient(string $address,
		string $name = null): EmailNotificationInterface
	{
		$this->_phpMailer->addAddress($address, $name);

		return $this;
	}

	public function addBcc(string $address,
		string $name = null): EmailNotificationInterface
	{
		$this->_phpMailer->addBCC($address, $name);

		return $this;
	}

	public function addCc(string $address,
		string $name = null): EmailNotificationInterface
	{
		$this->_phpMailer->addCC($address, $name);

		return $this;
	}

	public function addAttachment($attachment,
		string $name = null): EmailNotificationInterface
	{
		$this->_phpMailer->addAttachment($attachment);

		return $this;
	}

	public function setSubject(string $subject): EmailNotificationInterface
	{
		$this->_phpMailer->Subject = $subject;

		return $this;
	}

	public function setBody(string $body): EmailNotificationInterface
	{
		$this->_phpMailer->isHTML(true);
		$this->_phpMailer->Body = $body;

		return $this;
	}

	public function setAltBody(string $altBody): EmailNotificationInterface
	{
		$this->_phpMailer->AltBody = $altBody;

		return $this;
	}

	public function setCustomHeader(string $header,
		string $value): EmailNotificationInterface
	{
		$this->_phpMailer->addCustomHeader($header, $value);

		return $this;
	}
}