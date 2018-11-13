<?php


namespace App\Product\Repository;


use App\Product\Entity\Product;
use Ramsey\Uuid\UuidInterface;

interface ProductRepository
{
    public function get(UuidInterface $uuid);
    public function add(Product $product): void;
}