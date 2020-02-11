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
use PHPMailer\PHPMailer\Exception;


class PhpMailerEngine implements EmailNotificationInterface
{
	private $_phpMailer = null;

	public function __construct()
	{
		$this->_phpMailer = new PHPMailer(true);
	}

	public function setServerSettings()
	{
		$this->_phpMailer->isSMTP();
		$this->_phpMailer->Host = env('MAIL_HOST');
		$this->_phpMailer->Username = env('MAIL_USERNAME');
		$this->_phpMailer->Password = env('MAIL_PASSWORD');
		$this->_phpMailer->Port = env('MAIL_PORT');
		$this->_phpMailer->SMTPDebug = SMTP::DEBUG_SERVER;
		$this->_phpMailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
	}

	public function sendEmail()
	{
		$this->_phpMailer->send();
	}

	public function setHtmlEmail()
	{
		$this->_phpMailer->isHTML(true);
	}

	public function setTextEmail()
	{
		$this->_phpMailer->isHTML(false);
	}

	public function setFromAddress($address, $name = null)
	{
		$this->_phpMailer->setFrom($address, $name);
	}

	public function setRecipients($address, $name = null)
	{
		$this->_phpMailer->addAddress($address, $name);
	}

	public function setBCC($address, $name = null)
	{
		$this->_phpMailer->addBCC($address, $name);
	}

	public function setCC($address, $name = null)
	{
		$this->_phpMailer->addCC($address, $name);
	}

	public function setAttachment($attachment, $name = null)
	{
		$this->_phpMailer->addAttachment($attachment);
	}

	public function setSubject($subject){
		$this->_phpMailer->Subject = $subject;
	}

	public function setBody($body){
		$this->_phpMailer->Body = $body;
	}

	public function setAltBody($altBody){
		$this->_phpMailer->AltBody = $altBody;
	}

	public function setCustomHeader($header, $value)
	{
		$this->_phpMailer->addCustomHeader($header, $value);
	}

}