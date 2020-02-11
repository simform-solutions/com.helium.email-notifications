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

	public function __construct(EmailNotificationInterface $object) {
		$this->_emailEngine = $object;
	}

	public function sendHtmlEmail(array $data)
	{
		return $this->_emailEngine->sendHtmlEmail($data);
	}

	public function sendTextEmail(array $data)
	{
		return $this->_emailEngine->sendTextEmail($data);
	}
}