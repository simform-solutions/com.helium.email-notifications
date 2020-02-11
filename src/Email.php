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

	public function sendHtmlEmail()
	{
		return $this->_emailEngine->sendHtmlEmail();
	}

	public function sendTextEmail()
	{
		return $this->_emailEngine->sendTextEmail();
	}

}