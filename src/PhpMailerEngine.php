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
		$this->setServerSettings();
	}

	public function sendHtmlEmail(array $data)
	{
		$this->_phpMailer->isHTML(true);
		$this->setFromAddress($data['from_address'], $data['from_name']);
		$this->setRecipients($data['recipients']);
		$this->setContent($data['body'], $data['subject'], $data['alt_body']);
		$this->_phpMailer->send();
	}

	public function sendTextEmail(array $data)
	{
		$this->_phpMailer->isHTML(false);
		$this->setFromAddress($data['from_address'], $data['from_name']);
		$this->setRecipients($data['recipients']);
		$this->setContent($data['body'], $data['subject'], $data['alt_body']);
		$this->_phpMailer->send();
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

	public function setFromAddress($fromAddress, $name)
	{
		$this->_phpMailer->setFrom($fromAddress, $name);
	}

	public function setRecipients($addresses)
	{
		foreach ($addresses as $address) {
			$this->_phpMailer->addAddress($address);
		}
	}

	public function setBCC($addresses)
	{
		foreach ($addresses as $address) {
			$this->_phpMailer->addBCC($address);
		}
	}

	public function setCC($addresses)
	{
		foreach ($addresses as $address) {
			$this->_phpMailer->addCC($address);
		}
	}

	public function setAttachments($attachments)
	{
		foreach ($attachments as $attachment) {
			$this->_phpMailer->addAttachment($attachment);
		}
	}

	public function setContent($body, $subject, $altBody = null)
	{
		$this->_phpMailer->Subject = $subject;
		$this->_phpMailer->Body = $body;
		$this->_phpMailer->AltBody = $altBody;
	}

}