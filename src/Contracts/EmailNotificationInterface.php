<?php
/**
 * Created by PhpStorm.
 * User: spencermerryman
 * Date: 2020-02-10
 * Time: 15:07
 */

namespace Helium\EmailNotifications\Contracts;


interface EmailNotificationInterface
{
	public function sendEmail(): void;

	public function setServerSettings(
		array $serverSettings): EmailNotificationInterface;

	public function setFromAddress(string $address,
		string $name = null): EmailNotificationInterface;

	public function addRecipient(string $address,
		string $name = null): EmailNotificationInterface;

	public function addBcc(string $address,
		string $name = null): EmailNotificationInterface;

	public function addCc(string $address,
		string $name = null): EmailNotificationInterface;

	public function addAttachment(string $path,
		string $name = null): EmailNotificationInterface;

	public function setSubject(string $subject): EmailNotificationInterface;

	public function setBody(string $body): EmailNotificationInterface;

	public function setAltBody(string $altBody): EmailNotificationInterface;

	public function setCustomHeader(string $header,
		string $value): EmailNotificationInterface;
}