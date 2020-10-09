<?php
/**
 * Created by PhpStorm.
 * User: spencermerryman
 * Date: 2020-02-11
 * Time: 10:07
 */

namespace Helium\EmailNotifications\Engines;

use Helium\EmailNotifications\Contracts\EmailEngineContract;
use PHPMailer\PHPMailer\PHPMailer;

class PhpMailerEngine extends EmailEngineContract
{
	private $mailer = null;

	public function __construct()
	{
	    $this->setupNewMailer();
	}

    protected function setupNewMailer()
    {
        $this->mailer = new PHPMailer(config('email.engines.php_mailer.exceptions'));

        $this->mailer->Mailer = config('email.engines.php_mailer.mailer');
        $this->mailer->Host = config('email.defaults.host');
        $this->mailer->Username = config('email.defaults.username');
        $this->mailer->Password = config('email.defaults.password');
        $this->mailer->Port = config('email.defaults.port');
        $this->mailer->SMTPAuth = config('email.engines.php_mailer.smtp_auth');
        $this->mailer->SMTPDebug = 0;

        $this->setFromAddress(
            config('email.defaults.from_address'),
            config('email.defaults.from_name')
        );
	}

    public function send(): void
	{
		$this->mailer->send();

		$this->setupNewMailer();
	}

	public function setFromAddress(string $address,
		string $name = null): EmailEngineContract
	{
		$this->mailer->setFrom($address, $name);

		return $this;
	}

	public function addRecipient(string $address,
		string $name = null): EmailEngineContract
	{
		$this->mailer->addAddress($address, $name);

		return $this;
	}

	public function addBcc(string $address,
		string $name = null): EmailEngineContract
	{
		$this->mailer->addBCC($address, $name);

		return $this;
	}

	public function addCc(string $address,
		string $name = null): EmailEngineContract
	{
		$this->mailer->addCC($address, $name);

		return $this;
	}

	public function addAttachment(string $path,
		string $name = null): EmailEngineContract
	{
		$this->mailer->addAttachment($path);

		return $this;
	}

	public function setSubject(string $subject): EmailEngineContract
	{
		$this->mailer->Subject = $subject;

		return $this;
	}

	public function setBody(string $body): EmailEngineContract
	{
		$this->mailer->isHTML(true);
		$this->mailer->Body = $body;

		return $this;
	}

	public function setAltBody(string $altBody): EmailEngineContract
	{
		$this->mailer->AltBody = $altBody;

		return $this;
	}

	public function setCustomHeader(string $header,
		string $value): EmailEngineContract
	{
		$this->mailer->addCustomHeader($header, $value);

		return $this;
	}
}
