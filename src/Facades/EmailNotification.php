<?php
/**
 * Created by PhpStorm.
 * User: spencermerryman
 * Date: 2020-02-11
 * Time: 10:04
 */

namespace Helium\EmailNotifications\Facades;

use Illuminate\Support\Facades\Facade;

class EmailNotification extends Facade
{
	const FACADE_ACCESSOR = 'emailNotification';

	protected static function getFacadeAccessor()
	{
		return self::FACADE_ACCESSOR;
	}
}