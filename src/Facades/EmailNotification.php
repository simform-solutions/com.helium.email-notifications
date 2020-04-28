<?php
/**
 * Created by PhpStorm.
 * User: spencermerryman
 * Date: 2020-02-11
 * Time: 10:04
 */

namespace Helium\EmailNotifications\Facades;

use Helium\EmailNotifications\Contracts\EmailNotificationInterface;
use Helium\EmailNotifications\EmailNotificationManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static EmailNotificationInterface setServerSettings(array $serverSettings)
 * @method static EmailNotificationInterface setFromAddress(string $address, string $name = null)
 * @method static EmailNotificationInterface addRecipient(string $address, string $name = null)
 * @method static EmailNotificationInterface addBcc(string $address, string $name = null)
 * @method static EmailNotificationInterface addCc(string $address, string $name = null)
 * @method static EmailNotificationInterface addAttachment(string $attachment, string $name = null)
 * @method static EmailNotificationInterface setSubject(string $subject)
 * @method static EmailNotificationInterface setBody(string $body)
 * @method static EmailNotificationInterface setAltBody(string $altBody)
 * @method static EmailNotificationInterface setCustomHeader(string $header, string $value)
 * @method static void sendEmail()
 *
 * @see EmailNotificationManager
 */
class EmailNotification extends Facade
{
	const FACADE_ACCESSOR = 'emailNotification';

	protected static function getFacadeAccessor()
	{
		return self::FACADE_ACCESSOR;
	}
}