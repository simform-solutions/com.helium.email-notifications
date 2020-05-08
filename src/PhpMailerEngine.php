<?php
/**
 * Created by PhpStorm.
 * User: spencermerryman
 * Date: 2020-02-11
 * Time: 10:07
 */

namespace Helium\EmailNotifications;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


class PhpMailerEngine implements EmailNotificationInterface
{
	private $_phpMailer = null;

	public function __construct(bool $exceptions)
	{
		$this->_phpMailer = new PHPMailer($exceptions);
	}

	public function setServerSettings(array $serverSettings)
	{
		$this->_phpMailer->isSMTP();
		$this->_phpMailer->Host = $serverSettings['mail_host'];
		$this->_phpMailer->Username = $serverSettings['mail_username'];
		$this->_phpMailer->Password = $serverSettings['mail_password'];
		$this->_phpMailer->Port = $serverSettings['mail_port'];
		$this->_phpMailer->SMTPAuth = (!isset($serverSettings['mail_auth']) || $serverSettings['mail_auth']) ? true : false;
		$this->_phpMailer->SMTPDebug = 0;
	}

	public function sendEmail()
	{
		$this->_phpMailer->send();
	}

	public function setFromAddress(string $address, string $name = null)
	{
		$this->_phpMailer->setFrom($address, $name);
	}

	public function setRecipients(string $address, string $name = null)
	{
		$this->_phpMailer->addAddress($address, $name);
	}

	public function setBCC(string $address, string $name = null)
	{
		$this->_phpMailer->addBCC($address, $name);
	}

	public function setCC(string $address, string $name = null)
	{
		$this->_phpMailer->addCC($address, $name);
	}

	public function setAttachment($attachment, string $name = null)
	{
		$this->_phpMailer->addAttachment($attachment);
	}

	public function setSubject(string $subject){
		$this->_phpMailer->Subject = $subject;
	}

	public function setBody(string $body){
		$this->_phpMailer->isHTML(true);
		$this->_phpMailer->Body = $body;
	}

	public function setAltBody(string $altBody){
		$this->_phpMailer->AltBody = $altBody;
	}

	public function setCustomHeader(string $header, string $value)
	{
		$this->_phpMailer->addCustomHeader($header, $value);
	}

}