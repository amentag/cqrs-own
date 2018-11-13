<?php

namespace App\Product\Entity;

use App\Product\ValueObject\Money;
use Ramsey\Uuid\UuidInterface;

class Product
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @var Money
     */
    private $price;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;

    public function __construct(UuidInterface $uuid, string $name, string $description, Money $price)
    {
        $this->uuid = $uuid;
        $this->price = $price;
        $this->name = $name;
        $this->description = $description;
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function setPrice(Money $price): self
    {
        $this->price = $price;

        return $this;
    }
}