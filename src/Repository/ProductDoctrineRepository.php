<?php

namespace App\Repository;

use App\Entity\Product as ProductDoctrine;
use App\Product\Entity\Product;
use App\Product\Repository\ProductRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProductDoctrine|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductDoctrine|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductDoctrine[]    findAll()
 * @method ProductDoctrine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductDoctrineRepository extends ServiceEntityRepository implements ProductRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProductDoctrine::class);
    }

    public function get(UuidInterface $uuid): Product
    {
        return $this->findOneBy(['uuid' => $uuid->toString()]);
    }

    public function add(Product $product): void
    {
        $productDoctrine = $this->makeProductDoctrine($product);

        $em = $this->getEntityManager();
        $em->persist($productDoctrine);
        $em->flush();
    }

    public function makeProductDoctrine(Product $product)
    {
        return (new ProductDoctrine())
            ->setUuid($product->getUuid()->toString())
            ->setName($product->getName())
            ->setDescription($product->getDescription())
            ->setPrice($product->getPrice());
    }
}
