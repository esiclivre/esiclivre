<?php
namespace Esic;

class Entity
{
    /** @var string */
    private $address;

    /** @var string */
    private $mail;

    /** @var string */
    private $name;

    /** @var string */
    private $phone;

    /** @var string */
    private $serviceHours;

    public function __construct(
        string $name,
        string $mail,
        string $phone,
        string $address,
        string $serviceHours
    ) {
        $this->address = $address;
        $this->mail = $mail;
        $this->name = $name;
        $this->phone = $phone;
        $this->serviceHours = $serviceHours;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getServiceHours(): string
    {
        return $this->serviceHours;
    }
}
