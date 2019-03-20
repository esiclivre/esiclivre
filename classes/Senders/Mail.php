<?php
namespace Esic\Senders;

use Esic\Settings\Mailer as SettingsMailer;
use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    /** @var PHPMailer */
    private $sender;

    /** @var SettingsMailer */
    private $settings;

    public function __construct(SettingsMailer $settings)
    {
        $this->sender = new PHPMailer;
        $this->settings = $settings;
    }

    public function __clone()
    {
        $this->sender = clone $this->sender;
        $this->settings = clone $this->settings;
    }

    public function addTo(string $address, string $name = ''): self
    {
        $this->sender->addAddress($address, $name);
        return $this;
    }

    public function getError(): string
    {
        return $this->sender->ErrorInfo;
    }

    public function send(): bool
    {
        $this->sender->isSMTP();
        $this->sender->CharSet = 'utf-8';
        $this->sender->Host = $this->settings->getHost();
        $this->sender->SMTPAuth = $this->settings->getAuthentication();
        $this->sender->Username = $this->settings->getUser();
        $this->sender->Password = $this->settings->getPassword();
        $this->sender->SMTPSecure = $this->settings->getProtocol();
        $this->sender->Port = $this->settings->getPort();

        return $this->sender->send();
    }

    public function setBody(
        string $body,
        bool $isHtml = false,
        string $alternativeBody = ''
    ): self {
        $this->sender->Body = $body;
        $this->sender->AltBody = $alternativeBody;
        $this->sender->isHTML($isHtml);
        return $this;
    }

    public function setFrom(string $address, ?string $name): self
    {
        $this->sender->setFrom($address, $name);
        return $this;
    }

    public function setModeDebug(bool $active): self
    {
        $this->sender->SMTPDebug = ($active ? 2 : 0);
        return $this;
    }

    public function setSubject(string $subject): self
    {
        $this->sender->Subject = $subject;
        return $this;
    }
}
