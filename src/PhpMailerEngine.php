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

	public function sendHtmlEmail()
	{

	}

	public function sendTextEmail()
	{
	}

}