<?php

namespace App\Product\Command\Handler;

use App\Common\Command;
use App\Common\CommandHandler;
use App\Product\Command\AddNewProductCommand;
use App\Product\Entity\Product;
use App\Product\Repository\ProductRepository;
use App\Product\ValueObject\Currency;
use App\Product\ValueObject\Money;
use Ramsey\Uuid\Uuid;

class AddNewProductCommandHandler implements CommandHandler
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param Command|AddNewProductCommand $command
     */
    public function handle(Command $command): void
    {
        $product = new Product(
            Uuid::uuid4(),
            $command->name,
            $command->description,
            new Money($command->price, new Currency($command->currency))
        );
        $this->productRepository->add($product);
    }

    public function listenTo(): string
    {
        return AddNewProductCommand::class;
    }
}