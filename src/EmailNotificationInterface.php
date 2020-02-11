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
	public function sendHtmlEmail();

	public function sendTextEmail();
}