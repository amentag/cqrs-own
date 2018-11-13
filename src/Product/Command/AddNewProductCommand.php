<?php

namespace App\Product\Command;

use App\Common\Command;

class AddNewProductCommand implements Command
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $description;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $currency;

    public function __construct(string $name, string $description, float $price, string $currency)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->currency = $currency;
    }
}