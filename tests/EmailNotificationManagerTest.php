<?php

namespace Helium\EmailNotifications\Tests;

use Helium\EmailNotifications\EmailNotification;
use Helium\EmailNotifications\Tests\Fakes\FakeMailerEngine;
use Helium\ServiceManager\EngineContract;
use Helium\ServiceManager\ServiceManager;
use Helium\ServiceManager\Tests\Base\ServiceManagerPackageTest;

class EmailNotificationManagerTest extends ServiceManagerPackageTest
{
	protected function getInstance(): ServiceManager
	{
		$manager = new EmailNotification('fake');

		$manager->extend('fake', $this->getNewEngine());

		return $manager;
	}

	protected function getNewEngine(): EngineContract
	{
		return new FakeMailerEngine();
	}

	public function testPassthroughReturnsExpected()
	{
		$manager = $this->getInstance();

		$this->assertEquals(
			$manager->engine(),
			$manager->setServerSettings([])
		);

		$this->assertEquals(
			$manager->engine(),
			$manager->setFromAddress('')
		);

		$this->assertEquals(
			$manager->engine(),
			$manager->addRecipient('')
		);

		$this->assertEquals(
			$manager->engine(),
			$manager->addBcc('')
		);

		$this->assertEquals(
			$manager->engine(),
			$manager->addCc('')
		);

		$this->assertEquals(
			$manager->engine(),
			$manager->addAttachment('')
		);

		$this->assertEquals(
			$manager->engine(),
			$manager->setSubject('')
		);

		$this->assertEquals(
			$manager->engine(),
			$manager->setBody('')
		);

		$this->assertEquals(
			$manager->engine(),
			$manager->setAltBody('')
		);

		$this->assertEquals(
			$manager->engine(),
			$manager->setCustomHeader('', '')
		);

		$this->assertNull($manager->sendEmail());
	}
}