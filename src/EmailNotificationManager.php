<?php

namespace Helium\EmailNotifications;

use Helium\EmailNotifications\Contracts\EmailNotificationInterface;
use Helium\FacadeManager\FacadeManager;

/**
 * @mixin EmailNotificationInterface
 */
class EmailNotificationManager extends FacadeManager
{
	public function getEngineContract(): string
	{
		return EmailNotificationInterface::class;
	}
}