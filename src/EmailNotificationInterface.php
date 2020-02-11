<?php
/**
 * Created by PhpStorm.
 * User: spencermerryman
 * Date: 2020-02-10
 * Time: 15:07
 */

namespace Helium\EmailNotifications;


interface EmailNotificationInterface
{
	public function sendEmail();

	public function setServerSettings();

	public function setHtmlEmail();

	public function setTextEmail();

	public function setFromAddress($address, $name = null);

	public function setRecipients($address, $name = null);

	public function setBCC($address, $name = null);

	public function setCC($address, $name = null);

	public function setAttachment($attachment, $name = null);

	public function setSubject($subject);

	public function setBody($body);

	public function setAltBody($altBody);

	public function setCustomHeader($header, $value);
}