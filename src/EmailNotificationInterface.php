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

	public function setServerSettings(array $serverSettings);

	public function setFromAddress(string $address, string $name = null);

	public function setRecipients(string $address, string $name = null);

	public function setBCC(string $address, string $name = null);

	public function setCC(string $address, string $name = null);

	public function setAttachment($attachment, string $name = null);

	public function setSubject(string $subject);

	public function setBody(string $body);

	public function setAltBody(string $altBody);

	public function setCustomHeader(string $header, string $value);
}